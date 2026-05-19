<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\InstallationPackage;
use App\Models\Booking;
use App\Models\SiteSetting;
use App\Models\Affiliate;
use App\Models\AffiliateCommission;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingNotification;
use Webimpian\BayarcashSdk\Bayarcash;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->bayarcash = new Bayarcash($this->getConfig('api_token'));
        if ($this->getConfig('environment') === 'sandbox') {
            $this->bayarcash->useSandbox();
        }
        $this->bayarcash->setApiVersion('v2');
    }

    /**
     * Helper to get cleaned config values
     */
    private function getConfig($key)
    {
        $value = config("services.bayarcash.$key") ?? '';
        return trim($value, " \t\n\r\0\x0B\"'");
    }

    public function index()
    {
        $packages = InstallationPackage::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('category')
            ->get();
            
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        return view('frontend.booking.index', compact('packages', 'settings'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'preferred_date' => 'required|date|after:today',
            'items'          => 'required|array|min:1',
            'items.*.id'     => 'required|exists:installation_packages,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Resolve full package info for the session
        $resolvedItems = [];
        $totalPrice    = 0;
        foreach ($request->items as $item) {
            $pkg = InstallationPackage::find($item['id']);
            if (!$pkg) continue;
            $qty   = (int) $item['quantity'];
            $price = (float) $pkg->price;
            $resolvedItems[] = [
                'id'       => $pkg->id,
                'name'     => $pkg->name,
                'price'    => $price,
                'quantity' => $qty,
            ];
            $totalPrice += $price * $qty;
        }

        // Add to standard cart instead of separate flow
        $cart = session()->get('cart', []);
        
        // We use a fixed key 'booking_estimate' to ensure only one installation plan at a time
        $cart['booking_estimate'] = [
            'id' => 'booking_estimate',
            'name' => 'EV Charger Installation - ' . ($resolvedItems[0]['name'] ?? 'Custom Plan'),
            'quantity' => 1,
            'price' => $totalPrice,
            'image' => asset('storage/ev_charger_product_1773856128972.png'),
            'attributes' => [
                'type' => 'booking',
                'preferred_date' => $request->preferred_date,
                'items' => $resolvedItems,
            ]
        ];
        
        session()->put('cart', $cart);

        return redirect()->back()
            ->with('success', 'Installation plan added to your cart!')
            ->with('open_cart', true);
    }

    public function paymentPage()
    {
        $draft = session('booking_draft');
        if (!$draft) {
            return redirect()->route('booking.index')
                ->with('error', 'Please select a package and date first.');
        }

        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('frontend.booking.payment', compact('draft', 'settings'));
    }

    public function store(Request $request)
    {
        // Check honeypot field. If filled, it's a bot.
        if ($request->filled('_website_url')) {
            Log::warning('Spam attempt blocked via honeypot', ['ip' => $request->ip(), 'data' => $request->all()]);
            return back()->with('error', 'Spam detected. Your request has been blocked.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|min:9|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|min:10',
            'preferred_date' => 'required|date|after:today',
            'payment_method' => 'required|string|in:fpx,card,whatsapp',
            'items' => 'required|array',
            'items.*.id' => [
                'required',
                Rule::exists('installation_packages', 'id')->whereNull('deleted_at'),
            ],
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $referralCode = request()->cookie('referral_code');
        $affiliateId = null;
        if ($referralCode) {
            $affiliate = Affiliate::where('referral_code', $referralCode)->first();
            $affiliateId = $affiliate ? $affiliate->id : null;
        }

        $booking = Booking::create([
            'affiliate_id' => $affiliateId,
            'customer_name' => $validated['customer_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'preferred_date' => $validated['preferred_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'Pending',
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'pending',
            'order_number' => 'BOK-' . strtoupper(uniqid()),
        ]);

        $totalPrice = 0;
        foreach ($validated['items'] as $itemData) {
            $package = InstallationPackage::find($itemData['id']);
            $price = $package->price * $itemData['quantity'];
            
            $booking->items()->create([
                'installation_package_id' => $package->id,
                'quantity' => $itemData['quantity'],
                'price_at_booking' => $package->price,
            ]);
            
            $totalPrice += $price;
        }

        $booking->update(['total_price' => $totalPrice]);

        // If online payment, initiate Bayarcash
        if (in_array($validated['payment_method'], ['fpx', 'card'])) {
            // Prepare Bayar Cash Data
            $data = [
                'portal_key'             => $this->getConfig('portal_key'),
                'order_number'           => $booking->order_number,
                'amount'                 => $totalPrice,
                'payer_name'             => $booking->customer_name,
                'payer_email'            => $booking->email,
                'payer_telephone_number' => $booking->phone_number,
                'callback_url'           => route('booking.callback'),
                'return_url'             => route('booking.success', ['order' => $booking->order_number]),
            ];

            // Generate Checksum
            $checksum = $this->bayarcash->createPaymentIntentChecksumValue($this->getConfig('secret_key'), $data);
            $data['checksum'] = $checksum;

            Log::info('Bayar Cash Booking Request Data: ', $data);

            try {
                $response = $this->bayarcash->createPaymentIntent($data);
                Log::info('Bayar Cash Booking Response: ', (array) $response);

                if ($response && isset($response->url)) {
                    $booking->update([
                        'payment_url' => $response->url,
                        'bayarcash_transaction_id' => $response->id ?? null,
                    ]);

                    session()->forget('booking_draft');
                    return redirect($response->url);
                } else {
                    Log::error('Bayar Cash Booking Error: ' . json_encode($response));
                    return back()->with('error', 'Failed to initiate payment. Please try again.');
                }
            } catch (\Exception $e) {
                Log::error('Bayar Cash Booking Exception: ' . $e->getMessage());
                return back()->with('error', 'An error occurred while processing your payment.');
            }
        }

        // WhatsApp / Manual Booking
        try {
            $ccEmails = ['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'];
            $toEmail = $booking->email ?: 'amlifttechnology@gmail.com';

            Mail::to($toEmail)
                ->cc($ccEmails)
                ->send(new BookingNotification($booking));
        } catch (\Exception $e) {
            Log::error('Booking Email failed: ' . $e->getMessage());
        }

        session()->forget('booking_draft');
        return redirect()->route('booking.index')->with('success', 'Thank you! Your booking request for RM' . number_format($totalPrice, 2) . ' has been submitted successfully.');
    }

    public function callback(Request $request)
    {
        Log::info('Bayar Cash Booking Callback Received: ', $request->all());

        $orderNumber = $request->input('order_number');
        if (!$orderNumber) {
            return response()->json(['message' => 'Order number missing'], 400);
        }

        $booking = Booking::where('order_number', $orderNumber)->first();
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $status = $request->input('status'); // e.g., 'paid', 'failed'
        
        if ($status === 'paid' && $booking->payment_status !== 'paid') {
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
            ]);

            // Send Notification Email again if needed or similar
            try {
                $ccEmails = ['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'];
                $toEmail = $booking->email ?: 'amlifttechnology@gmail.com';

                Mail::to($toEmail)
                    ->cc($ccEmails)
                    ->send(new BookingNotification($booking));
            } catch (\Exception $e) {
                Log::error('Booking Confirmation Email failed: ' . $e->getMessage());
            }
        } elseif ($status === 'failed') {
            $booking->update(['payment_status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function success(Request $request)
    {
        $orderNumber = $request->input('order');
        $booking = Booking::where('order_number', $orderNumber)->with('items')->firstOrFail();
        
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        return view('frontend.booking_success', compact('booking', 'settings'));
    }
}

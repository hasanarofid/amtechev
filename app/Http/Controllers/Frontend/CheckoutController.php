<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Affiliate;
use App\Models\AffiliateCommission;
use App\Models\Charger;
use App\Mail\OrderInvoice;
use Illuminate\Http\Request;
use Webimpian\BayarcashSdk\Bayarcash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    protected $bayarcash;

    public function __construct()
    {
        // Robust cleaning: trim whitespace and surrounding quotes
        $token = trim(config('services.bayarcash.api_token') ?? '', " \t\n\r\0\x0B\"'");
        
        Log::info('Bayar Cash Token Initialization:', [
            'raw_length' => strlen(config('services.bayarcash.api_token') ?? ''),
            'cleaned_length' => strlen($token),
            'environment' => config('services.bayarcash.environment')
        ]);

        $this->bayarcash = new Bayarcash($token);
        if (config('services.bayarcash.environment') === 'sandbox') {
            $this->bayarcash->useSandbox();
        }
        $this->bayarcash->setApiVersion('v2');
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('catalog')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'email' => 'required|email',
            'first_name' => 'nullable|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'phone' => 'nullable|string',
        ]);

        // Update User Profile if logged in
        if (\Illuminate\Support\Facades\Auth::check()) {
            \Illuminate\Support\Facades\Auth::user()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'city' => $request->city,
                'postcode' => $request->postcode,
                'state' => $request->state,
                'country' => $request->country,
                'phone' => $request->phone,
            ]);
        }

        $total = 0;
        foreach ($cart as $item) {
            $price = (float)str_replace(['RM', ',', ' '], '', $item['price'] ?? 0);
            $total += $price * (int)($item['quantity'] ?? 1);
        }

        // Create Order
        $referralCode = request()->cookie('referral_code');
        $affiliateId = null;
        if ($referralCode) {
            $affiliate = Affiliate::where('referral_code', $referralCode)->first();
            $affiliateId = $affiliate ? $affiliate->id : null;
        }

        $order = Order::create([
            'affiliate_id' => $affiliateId,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'total_price' => $total,
            'customer_first_name' => $request->first_name,
            'customer_last_name' => $request->last_name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'customer_city' => $request->city,
            'customer_postcode' => $request->postcode,
            'customer_state' => $request->state,
            'customer_country' => $request->country,
            'payment_method' => 'bayarcash',
            'payment_status' => 'pending',
        ]);

        // Save Order Items
        foreach ($cart as $item) {
            $price = (float)str_replace(['RM', ',', ' '], '', $item['price'] ?? 0);
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'] ?? 'Product',
                'quantity' => (int)($item['quantity'] ?? 1),
                'price' => $price,
                'subtotal' => $price * (int)($item['quantity'] ?? 1),
                'image' => $item['image'] ?? null,
                'attributes' => [
                    'color' => $item['color'] ?? null,
                    'cable_length' => $item['cable_length'] ?? null,
                    'installation' => $item['installation'] ?? null,
                ]
            ]);
        }

        // Prepare Bayar Cash Data
        $data = [
            'portal_key'             => config('services.bayarcash.portal_key'),
            'order_number'           => $order->order_number,
            'amount'                 => $total,
            'payer_name'             => $request->first_name . ' ' . $request->last_name,
            'payer_email'            => $request->email,
            'payer_telephone_number' => $request->phone ?? '0000000000',
            'callback_url'           => route('checkout.callback'),
            'return_url'             => route('checkout.success', ['order' => $order->order_number]),
        ];

        // Generate Checksum
        $checksum = $this->bayarcash->createPaymentIntentChecksumValue(config('services.bayarcash.secret_key'), $data);
        $data['checksum'] = $checksum;

        Log::info('Bayar Cash Payment Request Data: ', $data);

        try {
            $response = $this->bayarcash->createPaymentIntent($data);
            Log::info('Bayar Cash Payment Response: ', (array) $response);

            if ($response && isset($response->url)) {
                $order->update([
                    'payment_url' => $response->url,
                    'bayarcash_transaction_id' => $response->id ?? null,
                ]);

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'url' => $response->url,
                        'order_number' => $order->order_number
                    ]);
                }

                return redirect($response->url);
            } else {
                Log::error('Bayar Cash Error: ' . json_encode($response));
                
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to initiate payment. Please try again.'
                    ], 400);
                }

                return back()->with('error', 'Failed to initiate payment. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Bayar Cash Exception: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An error occurred while processing your payment.');
        }
    }

    public function callback(Request $request)
    {
        Log::info('Bayar Cash Callback Received: ', $request->all());

        $orderNumber = $request->input('order_number');
        if (!$orderNumber) {
            return response()->json(['message' => 'Order number missing'], 400);
        }

        $order = Order::where('order_number', $orderNumber)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $status = $request->input('status'); // e.g., 'paid', 'failed'
        
        if ($status === 'paid' && $order->payment_status !== 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
            ]);

            // Affiliate Commission logic
            if ($order->affiliate_id) {
                $affiliate = $order->affiliate;
                $commissionAmount = $order->total_price * ($affiliate->commission_rate / 100);

                $commission = AffiliateCommission::create([
                    'affiliate_id' => $affiliate->id,
                    'order_id' => $order->id,
                    'amount' => $commissionAmount,
                    'status' => 'pending',
                ]);

                // Send Commission Email
                try {
                    \Illuminate\Support\Facades\Mail::to($affiliate->user->email)
                        ->cc(['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'])
                        ->send(new \App\Mail\AffiliateCommissionEarned($commission));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send commission email: ' . $e->getMessage());
                }
            }

            // Send Invoice Email
            try {
                Mail::to($order->customer_email)->send(new OrderInvoice($order));
                Log::info('Invoice email sent for order: ' . $order->order_number);
            } catch (\Exception $e) {
                Log::error('Failed to send invoice email: ' . $e->getMessage());
            }
        } elseif ($status === 'failed') {
            $order->update(['payment_status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function success(Request $request)
    {
        $orderNumber = $request->query('order');
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();
        
        // Final fallback to send email if callback was missed or delayed
        if ($order->payment_status === 'paid') {
            session()->forget('cart');
        }

        return view('frontend.checkout_success', compact('order'));
    }

    public function checkStatus($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json(['status' => 'not_found'], 404);
        }

        return response()->json([
            'payment_status' => $order->payment_status,
            'redirect_url' => route('checkout.success', ['order' => $order->order_number])
        ]);
    }
}

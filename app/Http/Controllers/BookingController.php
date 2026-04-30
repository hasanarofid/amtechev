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

class BookingController extends Controller
{
    public function index()
    {
        $packages = InstallationPackage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        return view('frontend.booking.index', compact('packages', 'settings'));
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
            'phone_number' => 'required|string|min:10|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|min:10',
            'preferred_date' => 'required|date|after:today',
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

        // Affiliate Commission logic
        if ($booking->affiliate_id && $totalPrice > 0) {
            $affiliate = $booking->affiliate;
            $commissionAmount = $totalPrice * ($affiliate->commission_rate / 100);

            $commission = AffiliateCommission::create([
                'affiliate_id' => $affiliate->id,
                'booking_id' => $booking->id,
                'amount' => $commissionAmount,
                'status' => 'pending',
            ]);

            // Send Commission Email
            try {
                \Illuminate\Support\Facades\Mail::to($affiliate->user->email)
                    ->cc(['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'])
                    ->send(new \App\Mail\AffiliateCommissionEarned($commission));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send commission email for booking: ' . $e->getMessage());
            }
        }

        // Send Email Notification
        try {
            $ccEmails = ['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'];
            $toEmail = $booking->email ?: 'amlifttechnology@gmail.com';

            Mail::to($toEmail)
                ->cc($ccEmails)
                ->send(new BookingNotification($booking));
        } catch (\Exception $e) {
            // Log the error but don't break the user experience
            Log::error('Booking Email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you! Your booking request for RM' . number_format($totalPrice, 2) . ' has been submitted successfully.');
    }
}

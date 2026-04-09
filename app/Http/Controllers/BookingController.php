<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InstallationPackage;
use App\Models\Booking;
use App\Models\SiteSetting;

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
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'preferred_date' => 'required|date|after:today',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:installation_packages,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::create([
            'customer_name' => $validated['customer_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'preferred_date' => $validated['preferred_date'],
            'notes' => $validated['notes'],
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

        return back()->with('success', 'Thank you! Your booking request for RM' . number_format($totalPrice, 2) . ' has been submitted successfully.');
    }
}

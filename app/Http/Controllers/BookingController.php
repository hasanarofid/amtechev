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
            'installation_package_id' => 'required|exists:installation_packages,id',
            'notes' => 'nullable|string',
        ]);

        Booking::create($validated);

        return back()->with('success', 'Thank you! Your booking request has been submitted successfully. Our team will contact you soon.');
    }
}

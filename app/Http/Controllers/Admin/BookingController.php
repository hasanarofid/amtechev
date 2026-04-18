<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\InstallationPackage;
use App\Mail\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['items.installationPackage'])->latest()->paginate(20);
        
        $limit = \App\Models\SiteSetting::where('key', 'daily_booking_limit')->first()->value ?? 2;
        
        $fullDates = Booking::selectRaw('preferred_date, count(*) as count')
            ->where('status', '!=', 'Cancelled')
            ->groupBy('preferred_date')
            ->having('count', '>=', $limit)
            ->get();

        return view('admin.bookings.index', compact('bookings', 'limit', 'fullDates'));
    }

    public function create()
    {
        $packages = InstallationPackage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        $limit = \App\Models\SiteSetting::where('key', 'daily_booking_limit')->first()->value ?? 2;
        
        $fullDates = Booking::selectRaw('preferred_date, count(*) as count')
            ->where('status', '!=', 'Cancelled')
            ->groupBy('preferred_date')
            ->having('count', '>=', $limit)
            ->get();
            
        return view('admin.bookings.create', compact('packages', 'limit', 'fullDates'));
    }

    public function store(Request $request)
    {
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

        $booking = Booking::create([
            'customer_name' => $validated['customer_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'preferred_date' => $validated['preferred_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'Confirmed', // Admin created bookings are confirmed by default
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

        // Send Email Notification
        try {
            $ccEmails = ['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'];
            $toEmail = $booking->email ?: 'amlifttechnology@gmail.com';

            Mail::to($toEmail)
                ->cc($ccEmails)
                ->send(new BookingNotification($booking));
        } catch (\Exception $e) {
            Log::error('Admin Booking Email failed: ' . $e->getMessage());
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully and notification email sent.');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $packages = InstallationPackage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        $limit = \App\Models\SiteSetting::where('key', 'daily_booking_limit')->first()->value ?? 2;
        
        $fullDates = Booking::selectRaw('preferred_date, count(*) as count')
            ->where('status', '!=', 'Cancelled')
            ->where('id', '!=', $booking->id)
            ->groupBy('preferred_date')
            ->having('count', '>=', $limit)
            ->get();

        $booking->load('items.installationPackage');

        return view('admin.bookings.edit', compact('booking', 'packages', 'limit', 'fullDates'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|min:3|max:255',
            'phone_number' => 'required|string|min:10|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|min:10',
            'preferred_date' => 'required|date',
            'status' => 'required|string|in:Pending,Confirmed,Completed,Cancelled',
            'items' => 'required|array',
            'items.*.id' => [
                'required',
                Rule::exists('installation_packages', 'id')->whereNull('deleted_at'),
            ],
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $booking->update([
            'customer_name' => $validated['customer_name'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'preferred_date' => $validated['preferred_date'],
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
        ]);

        // Re-calculate and sync items
        $booking->items()->delete();
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

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }

    public function calendar()
    {
        $bookings = Booking::select('id', 'customer_name', 'preferred_date', 'status')
            ->where('status', '!=', 'Cancelled')
            ->get()
            ->map(function ($booking) {
                // Color coding based on status
                $color = '#fbbf24'; // Amber-400 for Pending
                if ($booking->status == 'Confirmed') $color = '#22c55e'; // Green-500
                if ($booking->status == 'Completed') $color = '#3b82f6'; // Blue-500
                
                return [
                    'id' => $booking->id,
                    'title' => $booking->customer_name,
                    'start' => $booking->preferred_date,
                    'url' => route('admin.bookings.show', $booking->id),
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'allDay' => true,
                ];
            });

        return view('admin.bookings.calendar', compact('bookings'));
    }

    public function generateDummy(Request $request)
    {
        // Find existing "Client Amtech X" names
        $lastBooking = Booking::where('customer_name', 'LIKE', 'Client Amtech %')
            ->get()
            ->filter(function ($b) {
                return preg_match('/Client Amtech (\d+)/', $b->customer_name);
            })
            ->sortByDesc(function ($b) {
                preg_match('/Client Amtech (\d+)/', $b->customer_name, $matches);
                return (int) $matches[1];
            })
            ->first();

        $nextNumber = 1;
        if ($lastBooking) {
            preg_match('/Client Amtech (\d+)/', $lastBooking->customer_name, $matches);
            $nextNumber = (int) $matches[1] + 1;
        }

        $booking = Booking::create([
            'customer_name' => "Client Amtech {$nextNumber}",
            'phone_number' => '08123456789',
            'email' => "client.amtech{$nextNumber}@example.com",
            'address' => 'Dummy Address',
            'preferred_date' => $request->input('date', now()->toDateString()),
            'status' => 'Pending',
            'total_price' => 0,
            'notes' => 'Auto-generated dummy booking for calendar marking.',
        ]);

        return redirect()->route('admin.bookings.calendar')->with('success', "Booking for Client {$nextNumber} on {$booking->preferred_date} generated successfully.");
    }
}

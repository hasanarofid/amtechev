<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

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

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Confirmed,Completed,Cancelled',
            'notes' => 'nullable|string',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking status updated successfully.');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\SiteSetting;
use App\Models\BookingSlot;
use Carbon\Carbon;

class BookingAvailabilityController extends Controller
{
    public function index(Request $request)
    {
        $globalLimit = SiteSetting::where('key', 'daily_booking_limit')->first()->value ?? 2;
        
        // Get all dates that have bookings
        $bookingDates = Booking::where('status', '!=', 'Cancelled')
            ->pluck('preferred_date')
            ->unique();
            
        // Get specific slot overrides
        $slotOverrides = BookingSlot::whereIn('date', $bookingDates)
            ->get()
            ->pluck('capacity', 'date');

        // Get bookings grouped by date with labels
        $bookingsData = [];
        $bookingsRaw = Booking::where('status', '!=', 'Cancelled')
            ->get()
            ->groupBy('preferred_date');

        foreach ($bookingsRaw as $date => $items) {
            $limit = $slotOverrides[$date] ?? $globalLimit;
            $count = $items->count();
            
            $bookingsData[$date] = [
                'count' => $count,
                'is_full' => $count >= $limit,
                'limit' => $limit,
                'bookings' => $items->map(function($item) {
                    return [
                        'label' => $item->customer_name,
                    ];
                })
            ];
        }

        return response()->json([
            'limit' => (int)$globalLimit,
            'data' => $bookingsData
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\SiteSetting;
use Carbon\Carbon;

class BookingAvailabilityController extends Controller
{
    public function index(Request $request)
    {
        $limit = SiteSetting::where('key', 'daily_booking_limit')->first()->value ?? 2;
        
        // Get bookings grouped by date
        $bookings = Booking::selectRaw('preferred_date, count(*) as count')
            ->where('status', '!=', 'Cancelled')
            ->groupBy('preferred_date')
            ->get()
            ->mapWithKeys(function ($item) use ($limit) {
                return [$item->preferred_date => [
                    'count' => $item->count,
                    'is_full' => $item->count >= $limit
                ]];
            });

        return response()->json([
            'limit' => (int)$limit,
            'data' => $bookings
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingSlot;
use App\Models\SiteSetting;

class SlotController extends Controller
{
    public function index()
    {
        $globalLimit = SiteSetting::where('key', 'daily_booking_limit')->first();
        $slots = BookingSlot::orderBy('date', 'desc')->paginate(10);
        
        return view('admin.slots.index', compact('globalLimit', 'slots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:booking_slots,date',
            'capacity' => 'required|integer|min:1'
        ]);

        BookingSlot::create($request->all());

        return redirect()->back()->with('success', 'Custom slot capacity added successfully.');
    }

    public function updateGlobal(Request $request)
    {
        $request->validate([
            'value' => 'required|integer|min:1'
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'daily_booking_limit'],
            ['value' => $request->value]
        );

        return redirect()->back()->with('success', 'Global booking limit updated successfully.');
    }

    public function destroy(BookingSlot $slot)
    {
        $slot->delete();
        return redirect()->back()->with('success', 'Custom slot removed.');
    }
}

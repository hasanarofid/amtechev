<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with(['service', 'charger'])->latest()->get();
        return view('frontend.user.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'charger_id' => 'nullable|exists:chargers,id',
        ]);

        auth()->user()->orders()->create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'service_id' => $request->service_id,
            'charger_id' => $request->charger_id,
            'status' => 'pending',
            'total_price' => 0, // Placeholder
        ]);

        return redirect()->route('user.orders')->with('status', 'Order placed successfully!');
    }

    public function destroy(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->delete();
        return redirect()->route('user.orders')->with('status', 'Order removed.');
    }
}

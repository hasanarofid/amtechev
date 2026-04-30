<?php

namespace App\Http\Controllers\Api\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\AffiliatePayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayoutController extends Controller
{
    public function index()
    {
        $affiliate = Auth::user()->affiliate;

        $payouts = AffiliatePayout::where('affiliate_id', $affiliate->id)
            ->latest()
            ->paginate(15);

        return response()->json($payouts);
    }

    public function store(Request $request)
    {
        $affiliate = Auth::user()->affiliate;

        $request->validate([
            'amount' => 'required|numeric|min:50', // Minimum payout RM 50
            'bank_name' => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_account_name' => 'required|string',
        ]);

        if ($affiliate->balance < $request->amount) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        $payout = AffiliatePayout::create([
            'affiliate_id' => $affiliate->id,
            'amount' => $request->amount,
            'bank_name' => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name' => $request->bank_account_name,
            'status' => 'pending',
        ]);

        // Deduct balance immediately or wait for approval? 
        // Usually deduct immediately and restore if rejected.
        $affiliate->decrement('balance', $request->amount);

        return response()->json($payout, 201);
    }
}

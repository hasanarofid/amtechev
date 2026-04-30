<?php

namespace App\Http\Controllers\Api\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\AffiliateCommission;
use App\Models\AffiliateVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $affiliate = Auth::user()->affiliate;

        if (!$affiliate) {
            return response()->json(['message' => 'Affiliate profile not found'], 404);
        }

        $totalEarnings = AffiliateCommission::where('affiliate_id', $affiliate->id)
            ->where('status', 'approved')
            ->sum('amount');

        $pendingEarnings = AffiliateCommission::where('affiliate_id', $affiliate->id)
            ->where('status', 'pending')
            ->sum('amount');

        $totalClicks = AffiliateVisit::where('affiliate_id', $affiliate->id)->count();

        $recentCommissions = AffiliateCommission::where('affiliate_id', $affiliate->id)
            ->with(['order', 'booking'])
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'affiliate' => $affiliate,
            'stats' => [
                'total_earnings' => $totalEarnings,
                'pending_earnings' => $pendingEarnings,
                'total_clicks' => $totalClicks,
                'balance' => $affiliate->balance,
            ],
            'recent_commissions' => $recentCommissions,
        ]);
    }

    public function commissions(Request $request)
    {
        $affiliate = Auth::user()->affiliate;

        $commissions = AffiliateCommission::where('affiliate_id', $affiliate->id)
            ->with(['order', 'booking'])
            ->latest()
            ->paginate(15);

        return response()->json($commissions);
    }
}

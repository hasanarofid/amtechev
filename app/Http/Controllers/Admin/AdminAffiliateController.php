<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateCommission;
use App\Models\AffiliatePayout;
use Illuminate\Http\Request;

class AdminAffiliateController extends Controller
{
    public function index()
    {
        $affiliates = Affiliate::with('user')->withCount('commissions')->get();
        return view('admin.affiliates.index', compact('affiliates'));
    }

    public function commissions()
    {
        $commissions = AffiliateCommission::with(['affiliate.user', 'order', 'booking'])
            ->latest()
            ->paginate(20);
        return view('admin.affiliates.commissions', compact('commissions'));
    }

    public function payouts()
    {
        $payouts = AffiliatePayout::with('affiliate.user')
            ->latest()
            ->paginate(20);
        return view('admin.affiliates.payouts', compact('payouts'));
    }

    public function approveCommission(AffiliateCommission $commission)
    {
        $commission->update(['status' => 'approved']);
        return back()->with('success', 'Commission approved successfully.');
    }

    public function completePayout(AffiliatePayout $payout)
    {
        $payout->update(['status' => 'completed']);
        return back()->with('success', 'Payout marked as completed.');
    }
}

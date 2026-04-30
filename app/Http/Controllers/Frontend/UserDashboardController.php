<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class UserDashboardController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $user = auth()->user();
        $affiliate = $user->affiliate;
        
        $affiliateStats = null;
        if ($affiliate) {
            $affiliateStats = [
                'balance' => $affiliate->commissions()->where('status', 'approved')->sum('amount') - $affiliate->payouts()->where('status', 'completed')->sum('amount'),
                'total_clicks' => $affiliate->visits()->count(),
                'referral_link' => url('/ref/' . $affiliate->referral_code),
            ];
        }

        return view('frontend.user.dashboard', compact('settings', 'affiliate', 'affiliateStats'));
    }
}

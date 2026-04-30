<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\AffiliateVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AffiliateTrackingController extends Controller
{
    public function track(Request $request, $code)
    {
        $affiliate = Affiliate::where('referral_code', $code)->where('status', 'active')->first();

        if ($affiliate) {
            // Record the visit
            AffiliateVisit::create([
                'affiliate_id' => $affiliate->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referrer_url' => $request->header('referer'),
            ]);

            // Set cookie for 30 days
            return redirect('/')->withCookie(cookie('referral_code', $code, 60 * 24 * 30));
        }

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\AffiliateCommission;
use App\Models\AffiliatePayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $affiliate = $user->affiliate;

        if (!$affiliate) {
            return redirect()->route('affiliate.join');
        }

        $stats = [
            'balance' => $affiliate->commissions()->where('status', 'approved')->sum('amount') - $affiliate->payouts()->where('status', 'completed')->sum('amount'),
            'total_earnings' => $affiliate->commissions()->where('status', 'approved')->sum('amount'),
            'pending_earnings' => $affiliate->commissions()->where('status', 'pending')->sum('amount'),
            'total_clicks' => $affiliate->visits()->count(),
        ];

        $commissions = $affiliate->commissions()->latest()->take(10)->get();

        return view('frontend.affiliate.dashboard', compact('affiliate', 'stats', 'commissions'));
    }

    public function join()
    {
        if (Auth::user()->affiliate) {
            return redirect()->route('affiliate.dashboard');
        }
        return view('frontend.affiliate.join');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->affiliate) {
            return redirect()->route('affiliate.dashboard');
        }

        $affiliate = Affiliate::create([
            'user_id' => $user->id,
            'referral_code' => $this->generateUniqueCode(),
            'status' => 'active',
        ]);

        // Send Welcome Email
        try {
            \Illuminate\Support\Facades\Mail::to($user->email)
                ->cc(['amlifttechnology@gmail.com', 'hasanarofid@gmail.com'])
                ->send(new \App\Mail\AffiliateRegistered($affiliate));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send affiliate welcome email: ' . $e->getMessage());
        }

        return redirect()->route('affiliate.dashboard')->with('success', 'Welcome to our Affiliate Program!');
    }

    private function generateUniqueCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Affiliate::where('referral_code', $code)->exists());

        return $code;
    }

    public function history()
    {
        $commissions = Auth::user()->affiliate->commissions()->latest()->paginate(20);
        return view('frontend.affiliate.history', compact('commissions'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view('admin.analytics.index');
    }

    public function guide()
    {
        return view('admin.analytics.guide');
    }

    /**
     * Proxy: Google Analytics 4 Data API
     * Requires: GA4_PROPERTY_ID, GOOGLE_CLIENT_ID, GOOGLE_CLIENT_SECRET, GOOGLE_REFRESH_TOKEN
     */
    public function ga4(Request $request)
    {
        try {
            $token = $this->getAccessToken();

            $propertyId = config('services.google.ga4_property_id');

            $response = Http::withToken($token)
                ->post("https://analyticsdata.googleapis.com/v1beta/properties/{$propertyId}:runReport", [
                    'dateRanges' => [['startDate' => '28daysAgo', 'endDate' => 'today']],
                    'metrics'    => [
                        ['name' => 'sessions'],
                        ['name' => 'totalUsers'],
                        ['name' => 'bounceRate'],
                        ['name' => 'screenPageViews'],
                        ['name' => 'conversions'],
                    ],
                    'dimensions' => [['name' => 'date']],
                    'orderBys'   => [['dimension' => ['dimensionName' => 'date']]],
                ]);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Proxy: Google Ads API (kampanye summary)
     * Requires: GOOGLE_ADS_DEVELOPER_TOKEN, GOOGLE_ADS_CUSTOMER_ID
     */
    public function googleAds(Request $request)
    {
        try {
            $token      = $this->getAccessToken();
            $customerId = config('services.google.ads_customer_id');
            $devToken   = config('services.google.ads_developer_token');

            $query = "SELECT campaign.name, campaign.status, metrics.clicks, metrics.impressions, metrics.cost_micros, metrics.ctr FROM campaign WHERE segments.date DURING LAST_30_DAYS";

            $response = Http::withToken($token)
                ->withHeaders(['developer-token' => $devToken])
                ->post("https://googleads.googleapis.com/v22/customers/{$customerId}/googleAds:searchStream", [
                    'query' => $query,
                ]);

            if (!$response->ok()) {
                $errorData = $response->json();
                $specificError = $errorData[0]['error']['details'][0]['errors'][0]['message'] ?? null;
                $genericError = $errorData[0]['error']['message'] ?? $response->body();
                
                $errorMessage = $specificError ? "{$genericError}: {$specificError}" : $genericError;
                throw new \Exception($errorMessage);
            }

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Proxy: Google Tag Manager API (list containers)
     * Requires: GTM_ACCOUNT_ID
     */
    public function gtm(Request $request)
    {
        try {
            $token     = $this->getAccessToken();
            $accountId = config('services.google.gtm_account_id');

            $response = Http::withToken($token)
                ->get("https://www.googleapis.com/tagmanager/v2/accounts/{$accountId}/containers");

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Exchange refresh token for access token (OAuth2)
     */
    private function getAccessToken(): string
    {
        $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id'     => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'refresh_token' => config('services.google.refresh_token'),
            'grant_type'    => 'refresh_token',
        ]);

        if (!$response->ok()) {
            throw new \Exception('Gagal mendapatkan access token: ' . $response->body());
        }

        return $response->json('access_token');
    }
}

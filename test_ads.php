<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$token = Http::asForm()->post('https://oauth2.googleapis.com/token', [
    'client_id'     => config('services.google.client_id'),
    'client_secret' => config('services.google.client_secret'),
    'refresh_token' => config('services.google.refresh_token'),
    'grant_type'    => 'refresh_token',
])->json('access_token');

$customerId = config('services.google.ads_customer_id');
$devToken   = config('services.google.ads_developer_token');

$query = "SELECT campaign.name, campaign.status, metrics.clicks, metrics.impressions, metrics.cost_micros, metrics.ctr FROM campaign WHERE segments.date DURING LAST_30_DAYS";

$response = Http::withToken($token)
    ->withHeaders(['developer-token' => $devToken])
    ->post("https://googleads.googleapis.com/v17/customers/{$customerId}/googleAds:searchStream", [
        'query' => $query,
    ]);

echo "Status: " . $response->status() . "\n";
echo "Response: " . $response->body() . "\n";

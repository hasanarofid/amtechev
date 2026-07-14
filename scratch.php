<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$token = Http::asForm()->post('https://oauth2.googleapis.com/token', [
    'client_id'     => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'refresh_token' => env('GOOGLE_REFRESH_TOKEN'),
    'grant_type'    => 'refresh_token',
])->json('access_token');

$devToken = env('GOOGLE_ADS_DEVELOPER_TOKEN');
$customerId = env('GOOGLE_ADS_CUSTOMER_ID');

$query = "SELECT campaign.name, campaign.status, metrics.clicks, metrics.impressions, metrics.cost_micros, metrics.ctr FROM campaign WHERE segments.date DURING LAST_30_DAYS";

for ($v = 15; $v <= 22; $v++) {
    $version = "v$v";
    $response = Http::withToken($token)
        ->withHeaders(['developer-token' => $devToken])
        ->post("https://googleads.googleapis.com/{$version}/customers/{$customerId}/googleAds:searchStream", [
            'query' => $query,
        ]);
    echo "$version: " . $response->status() . " " . $response->body() . "\n";
}

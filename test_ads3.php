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

// Let's try v17 again but handle json error
$response = Http::withToken($token)
    ->withHeaders(['developer-token' => $devToken])
    ->post("https://googleads.googleapis.com/v17/customers/{$customerId}/googleAds:searchStream", [
        'query' => "SELECT campaign.name FROM campaign LIMIT 1",
    ]);

echo "Status v17: " . $response->status() . "\n";
echo "Response v17 (first 100 chars): " . substr($response->body(), 0, 100) . "\n\n";

// Let's try v15, v16, v17
foreach (['v15', 'v16', 'v17', 'v18'] as $v) {
    $res = Http::withToken($token)
    ->withHeaders(['developer-token' => $devToken])
    ->post("https://googleads.googleapis.com/{$v}/customers/{$customerId}/googleAds:searchStream", [
        'query' => "SELECT campaign.name FROM campaign LIMIT 1",
    ]);
    echo "Status {$v}: " . $res->status() . "\n";
    if ($res->status() != 404) {
        echo "Response {$v}: " . $res->body() . "\n\n";
    }
}

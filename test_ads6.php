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

foreach (['v22', 'v23', 'v24', 'v25', 'v26', 'v27'] as $v) {
    $res = Http::withToken($token)
    ->withHeaders(['developer-token' => $devToken])
    ->post("https://googleads.googleapis.com/{$v}/customers/{$customerId}/googleAds:searchStream", [
        'query' => "SELECT campaign.name FROM campaign LIMIT 1",
    ]);
    echo "Status {$v}: " . $res->status() . "\n";
    if ($res->status() != 404) {
        echo "Response {$v}: " . $res->body() . "\n\n";
        break;
    }
}

<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$customerId = config('services.google.ads_customer_id');
echo "ID: '$customerId'\nLength: " . strlen($customerId) . "\n";

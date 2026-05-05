<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\GeminiService;

$gemini = new GeminiService();
$articleContext = "Article: Beli Kereta EV Bukan Untuk Jimat Petrol Sahaja, Perlu Pertimbangkan Beberapa Perkara.
Key points:
1. EV is not just about saving petrol.
2. Need to consider free public chargers (offices, malls).
3. Landed property is best for home wallbox and solar panels.
4. Condo owners need to check for existing chargers.
5. Travel planning is essential for long distances.
6. Driving style (keeping under 120km/h) preserves battery.
7. EV is high torque/fast but should be driven 'low key'.";

$content1 = $gemini->generateContent($articleContext . " Focus on charging infrastructure and home charging benefits.");
echo json_encode($content1, JSON_PRETTY_PRINT);
echo "\n---\n";
$content2 = $gemini->generateContent($articleContext . " Focus on driving habits and travel planning for EV owners.");
echo json_encode($content2, JSON_PRETTY_PRINT);

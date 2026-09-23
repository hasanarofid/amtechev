<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Console & Automated SEO Schedule
|--------------------------------------------------------------------------
| Automatically generates and schedules in-depth, authoritative EV articles
| using Gemini AI to maintain high content quality for Google AdSense & SEO.
*/
Schedule::command('blog:generate-content --auto --count=1')
    ->days([2, 5])
    ->at('08:00')
    ->withoutOverlapping()
    ->runInBackground();

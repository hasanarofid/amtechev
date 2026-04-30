<?php

use App\Http\Controllers\Api\Affiliate\AuthController;
use App\Http\Controllers\Api\Affiliate\DashboardController;
use App\Http\Controllers\Api\Affiliate\PayoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('affiliate')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/google-login', [AuthController::class, 'googleLogin']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/commissions', [DashboardController::class, 'commissions']);
        Route::get('/payouts', [PayoutController::class, 'index']);
        Route::post('/payouts', [PayoutController::class, 'store']);
    });
});

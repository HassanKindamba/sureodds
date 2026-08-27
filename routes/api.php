<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

// Route ya kupata taarifa za user aliyelogin (Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Callback/Webhook URL utakayoiweka kwenye AzamPay Dashboard
Route::post('/azampay/callback', [PaymentController::class, 'handleCallback']);
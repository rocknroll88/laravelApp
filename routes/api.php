<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YooMoneyController;
use App\Http\Controllers\ChatGptController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(YooMoneyController::class)->prefix('yoomoney')->group(function () {
    Route::post('/payment', 'setPayment');
    Route::get('/banks', 'getSpbBanks');
    Route::get('/payment-info/{paymentId}', 'getPaymentInfo');
});

Route::controller(ChatGptController::class)->prefix('chatgpt')->group(function () {
    Route::get('/get-info', 'getInfo');
});

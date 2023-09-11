<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\TestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test', [CarsController::class, 'getCars']);

//Route::get('/yoomoney/payment-info', [CarsController::class, 'getPaymentInfo']);
//Route::get('/yoomoney/banks', [CarsController::class, 'getSpbBanks']);
//Route::get('/yoomoney/payment', [CarsController::class, 'setPayment']);


//Route::get('/factory', [TestController::class, 'index']);

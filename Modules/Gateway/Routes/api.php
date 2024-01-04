<?php

use Illuminate\Http\Request;
use Modules\Gateway\Http\Controllers\Api\GatewayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/gateway', function (Request $request) {
    return $request->user();
});

Route::prefix('gateway')->as('gateway.')->group(function () {
    Route::get('/order', [GatewayController::class, 'order'])->name('order');
    Route::get('/payment', [GatewayController::class, 'paymentGateways'])->name('payment');
    Route::get('/payment/{gateway}/pay', [GatewayController::class, 'pay'])->name('pay');
    Route::post('/pay/{gateway}/complete', [GatewayController::class, 'makePayment'])->name('complete');
    Route::get('/pay/{gateway}/callback', [GatewayController::class, 'paymentCallback'])->name('callback');
    Route::get('/pay/{gateway}/cancelled', [GatewayController::class, 'paymentCancelled'])->name('cancel');
    Route::post('/pay/{gateway}/payment_webhook', [GatewayController::class, 'paymentHook'])->name('webhook');
    Route::get('enable-module', [GatewayController::class, 'enableModule'])->name('enable-module');
    Route::get('disable-module', [GatewayController::class, 'disableModule'])->name('disable-module');
});

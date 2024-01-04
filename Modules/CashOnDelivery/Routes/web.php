<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Modules\CashOnDelivery\Http\Controllers\CashOnDeliveryController;

Route::prefix('cashondelivery')->as('cash.')->group(function() {
    Route::post('/store', [CashOnDeliveryController::class, 'store'])->name('store');
    Route::get('/edit', [CashOnDeliveryController::class, 'edit'])->name('edit');
});

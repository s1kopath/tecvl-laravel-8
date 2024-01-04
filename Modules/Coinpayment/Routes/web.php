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

use Modules\Coinpayment\Http\Controllers\CoinpaymentController;

Route::prefix('gateway/coinpayment')->as('coinpayment.')->group(function () {
    Route::post('/store', [CoinpaymentController::class, 'store'])->name('store');
    Route::get('/edit', [CoinpaymentController::class, 'edit'])->name('edit');
});

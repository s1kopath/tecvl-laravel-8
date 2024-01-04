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

use Modules\Coinbase\Http\Controllers\CoinbaseController;

Route::prefix('gateway/coinbase')->as('coinbase.')->group(function () {
    Route::post('/store', [CoinbaseController::class, 'store'])->name('store');
    Route::get('/edit', [CoinbaseController::class, 'edit'])->name('edit');
});

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

use Modules\Paypal\Http\Controllers\PaypalController;


Route::prefix('gateway/paypal')->as('paypal.')->group(function () {
    Route::post('/store', [PaypalController::class, 'store'])->name('store');
    Route::get('/edit', [PaypalController::class, 'edit'])->name('edit');
});

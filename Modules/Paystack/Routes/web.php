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

use Modules\Paystack\Http\Controllers\PaystackController;

Route::prefix('gateway/paystack')->as('paystack.')->group(function () {
    Route::post('/store', [PaystackController::class, 'store'])->name('store');
    Route::get('/edit', [PaystackController::class, 'edit'])->name('edit');
});

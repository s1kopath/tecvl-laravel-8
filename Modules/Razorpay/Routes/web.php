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

use Modules\Razorpay\Http\Controllers\RazorpayController;

Route::prefix('razorpay')->as('razorpay.')->group(function () {
    Route::post('/store', [RazorpayController::class, 'store'])->name('store');
    Route::get('/edit', [RazorpayController::class, 'edit'])->name('edit');
});

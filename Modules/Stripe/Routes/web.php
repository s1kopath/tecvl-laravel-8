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

use Modules\Stripe\Http\Controllers\StripeController;

Route::prefix('gateway/stripe')->as('stripe.')->group(function () {
    Route::post('/store', [StripeController::class, 'store'])->name('store');
    Route::get('/edit', [StripeController::class, 'edit'])->name('edit');
});

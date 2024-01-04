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

use Modules\Instamojo\Http\Controllers\InstamojoController;

Route::prefix('gateway/instamojo')->as('instamojo.')->group(function () {
    Route::post('/store', [InstamojoController::class, 'store'])->name('store');
    Route::get('/edit', [InstamojoController::class, 'edit'])->name('edit');
});

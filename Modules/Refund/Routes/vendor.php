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


Route::group(['middleware' => ['auth', 'locale', 'permission']], function () {

    Route::get('/refund-requests', 'RefundController@index')->name('vendor.refund.index');
    Route::get('/refund-request/edit/{id}', 'RefundController@edit')->name('vendor.refund.edit');
    Route::post('/refund-request/update', 'RefundController@update')->name('vendor.refund.update');
    Route::get('/refund-request/pdf', 'RefundController@pdf')->name('vendor.refund.pdf');
    Route::get('/refund-request/csv', 'RefundController@csv')->name('vendor.refund.csv');

    Route::post('/refund-process', 'RefundProcessController@process')->name('vendor.refundProcess');
});

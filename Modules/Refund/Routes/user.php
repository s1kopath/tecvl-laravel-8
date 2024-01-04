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
    Route::get('/user/refund-request', 'RefundController@index')->name('site.refundRequest');
    Route::get('/user/create-refund-request', 'RefundController@createRequest')->name('site.createRefundRequest');
    Route::post('/user/order-refund', 'RefundController@refund')->name('site.orderRefund');
    Route::get('/user/refund-details/{id}', 'RefundController@refundDetails')->name('site.refundDetails');

    Route::get('/user/refund-items/{reference}', 'RefundController@getItems')->name('site.refund.items');

    Route::post('/user/refund-process', 'RefundProcessController@process')->name('site.refundProcess');
});


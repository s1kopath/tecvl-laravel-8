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
    Route::get('/user/refund-request', 'UserRefundController@index')->name('site.refundRequest');
   
    Route::match(['get', 'post'], '/user/order-refund', 'UserRefundController@refund')->name('site.orderRefund');

    Route::prefix('admin')->group(function () {
        Route::get('/refund-requests', 'RefundController@index')->name('refund.index');
        Route::get('/refund-request/edit/{id}', 'RefundController@edit')->name('refund.edit');
        Route::post('/refund-request/update', 'RefundController@update')->name('refund.update');
        Route::get('/refund-request/pdf', 'RefundController@pdf')->name('refund.pdf');
        Route::get('/refund-request/csv', 'RefundController@csv')->name('refund.csv');
    });
});

Route::get('/user/create-refund-request', 'UserRefundController@createRequest')->name('site.refundRequest');

<?php

/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth', 'locale', 'permission']], function() {

    // Vendor Coupon
    Route::get('coupons', 'CouponController@index')->name('vendor.coupons');
    Route::get('coupon/create', 'CouponController@create')->name('vendor.couponCreate');
    Route::post('coupon/store', 'CouponController@store')->name('vendor.couponStore');
    Route::get('coupon/edit/{id}', 'CouponController@edit')->name('vendor.couponEdit');
    Route::post('coupon/update/{id}', 'CouponController@update')->name('vendor.couponUpdate');
    Route::post('coupon/destroy/{id}', 'CouponController@destroy')->name('vendor.couponDelete');
    Route::get('coupon/pdf', 'CouponController@pdf')->name('vendor.couponPdf');
    Route::get('coupon/csv', 'CouponController@csv')->name('vendor.couponCsv');
    Route::get('coupon/shop-item/{id}', 'CouponController@item')->name('vendor.couponItem');
});

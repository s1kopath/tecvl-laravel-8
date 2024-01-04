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

Route::group(['middleware' => ['auth', 'locale', 'permission']], function() {
    // Coupon
    Route::get('coupons', 'CouponController@index')->name('coupon.index');
    Route::get('coupon/create', 'CouponController@create')->name('coupon.create');
    Route::post('coupon/store', 'CouponController@store')->name('coupon.store');
    Route::get('coupon/edit/{id}', 'CouponController@edit')->name('coupon.edit');
    Route::post('coupon/update/{id}', 'CouponController@update')->name('coupon.update');
    Route::post('coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.delete');
    Route::get('coupon/pdf', 'CouponController@downloadPdf')->name('coupon.pdf');
    Route::get('coupon/csv', 'CouponController@downloadCsv')->name('coupon.csv');
    Route::get('coupon/shop/{id}', 'CouponController@getShopByVendor')->name('coupon.shop');
    Route::get('coupon/item/{id}', 'CouponController@getCouponItem')->name('coupon.item');

    // Coupon Redeem
    Route::get('coupon-redeems', 'CouponRedeemController@index')->name('couponRedeem.index');
    Route::get('coupon-redeem/pdf', 'CouponRedeemController@pdf')->name('couponRedeem.pdf');
    Route::get('coupon-redeem/csv', 'CouponRedeemController@csv')->name('couponRedeem.csv');
});

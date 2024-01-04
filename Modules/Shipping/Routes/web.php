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
    // Shipping
    Route::get('shippings', 'ShippingController@index')->name('shipping.index');
    Route::get('shipping/create', 'ShippingController@create')->name('shipping.create');
    Route::post('shipping/store', 'ShippingController@store')->name('shipping.store');
    Route::get('shipping/edit/{id}', 'ShippingController@edit')->name('shipping.edit');
    Route::post('shipping/update/{id}', 'ShippingController@update')->name('shipping.update');
    Route::post('shipping/delete/{id}', 'ShippingController@destroy')->name('shipping.delete');
});

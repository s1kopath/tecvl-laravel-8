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

     // Vendor Shop
    Route::get('shop', 'ShopController@index')->name('vendor.shop.index');
    Route::get('shop/create', 'ShopController@create')->name('vendor.shop.create');
    Route::post('shop/store', 'ShopController@store')->name('vendor.shop.store');
    Route::get('shop/edit/{id}', 'ShopController@edit')->name('vendor.shop.edit');
    Route::post('shop/update/{id}', 'ShopController@update')->name('vendor.shop.update');
    Route::post('shop/delete/{id}', 'ShopController@destroy')->name('vendor.shop.destroy');
    Route::get('shop/pdf/{id}', 'ShopController@pdf')->name('vendor.shop.pdf');
    Route::get('shop/csv/{id}', 'ShopController@csv')->name('vendor.shop.csv');

});

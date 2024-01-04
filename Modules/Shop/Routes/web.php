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
    Route::prefix('admin')->group(function () {
        Route::get('shop', 'ShopController@index')->name('shop.index');
        Route::get('shop/create', 'ShopController@create')->name('shop.create');
        Route::post('shop/store', 'ShopController@store')->name('shop.store');
        Route::get('shop/edit/{id}', 'ShopController@edit')->name('shop.edit');
        Route::post('shop/update/{id}', 'ShopController@update')->name('shop.update');
        Route::post('shop/delete/{id}', 'ShopController@destroy')->name('shop.destroy');
        Route::get('shop/pdf', 'ShopController@pdf')->name('shop.pdf');
        Route::get('shop/csv', 'ShopController@csv')->name('shop.csv');
        Route::get('shop/pdf/{id}', 'ShopController@shopPdf')->name('shopPdf.pdf');
        Route::get('shop/csv/{id}', 'ShopController@shopCsv')->name('shopCsv.csv');
    });

});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api', 'locale', 'permission']], function() {
    // Shop
    Route::get('shop/list','ShopController@index');
    Route::post('shop/store','ShopController@store');
    Route::post('shop/update/{id}','ShopController@update');
    Route::get('shop/view/{id}','ShopController@detail');
    Route::delete('shop/delete/{id}','ShopController@destroy');

});

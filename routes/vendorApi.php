<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth:api', 'locale', 'permission-api']], function() {

    // Item
    Route::get('items', 'ApiVendorItemController@index');
    Route::post('item/store', 'ApiVendorItemController@store');
    Route::post('item/update/{id}', 'ApiVendorItemController@update');
    Route::post('item/search/{type}', 'ApiVendorItemController@search');
    Route::get('item/view/{id}', 'ApiVendorItemController@detail');
    Route::post('item/related/update/{type}', 'ApiVendorItemController@updateRealte');
    Route::post('item/delete/{id}', 'ApiVendorItemController@destroy');
});

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

Route::post('/login', '\App\Http\Controllers\Api\AuthController@login');
Route::post('/registration', '\App\Http\Controllers\Api\AuthController@signUp');

Route::post('password/reset-link', '\App\Http\Controllers\Api\AuthController@sendResetLinkEmail');
Route::post('password/reset', '\App\Http\Controllers\Api\AuthController@setPassword');
Route::get('otp-validity/{otp}', '\App\Http\Controllers\Api\AuthController@checkOtp');

Route::group(['middleware' => ['auth:api', 'locale', 'permission-api']], function() {
    //User profile
    Route::get('/profile', 'UserController@profile');
    Route::post('/profile/update', 'UserController@update');
    Route::get('/logout', '\App\Http\Controllers\Api\AuthController@logout');

    // User address
    Route::get('/addresses', 'AddressController@addresses');
    Route::post('/address/store', 'AddressController@storeAddress');
    Route::post('/address/update', 'AddressController@updateAddress');
    Route::delete('/address/delete/{id}', 'AddressController@destroyAddress');

    // User setting
    Route::post('/password/update', 'UserController@updatePassword');
    Route::delete('/account/delete', 'UserController@destroy');

    // User wishlist
    Route::get('/wishlists', 'WishlistController@index');
    Route::delete('/wishlist/delete/{id}', 'WishlistController@destroy');

    // User review
    Route::get('/reviews', 'ReviewController@index');

    // User order
    Route::get('/orders', 'OrderController@index');
    Route::get('/order/detail/{id}', 'OrderController@details')->whereNumber('id');

    // Order
    Route::post('order-store', 'OrderController@store');
    Route::get('order-paid/', 'OrderController@checkoutPayment');

    // Check Out
    Route::get('checkout', 'OrderController@checkOut')->name('siteApi.orderpaid');

});

// Category
Route::get('/categories/{param}', 'CategoryController@index');
Route::get('/categories/sub-category/{parentId}', 'CategoryController@subCategory');

// Item
Route::get('/item/{param}', 'ItemController@index');

// Filter
Route::post('/item/search', 'ItemController@search');

// Top brand
Route::get('/brand/{param}', 'BrandController@index');

// cart
Route::get('carts', 'CartController@index');
Route::post('cart/store', 'CartController@store');
Route::post('cart/reduce-qty', 'CartController@reduceQuantity');
Route::post('cart/delete', 'CartController@destroy');
Route::post('cart/selected-delete', 'CartController@destroySelected');
Route::post('cart/selected-store', 'CartController@storeSelected');
Route::post('cart/all-delete', 'CartController@destroyAll');

// check coupon
Route::post('check-coupon', 'CartController@checkCoupon');

// Get Stock
Route::post('get-stock', 'CartController@getStock');

// Seller Recommendation
Route::get('top-seller', 'UserController@topSeller');

// Order tracking
Route::post('track-order', 'UserController@track');

// login or register by google or facebook
Route::post('login/sso', '\App\Http\Controllers\Api\AuthController@registerOrLoginUser');

// Recent search
Route::get('/recent-search', 'ItemController@recentSearch');

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

Route::post('/login', 'AuthController@login');
Route::post('password/reset-link', 'AuthController@sendResetLinkEmail');
Route::post('password/reset', 'AuthController@setPassword');
Route::get('user/verification/{otp}', 'AuthController@verifyEmail');
Route::group(['middleware' => ['auth:api', 'locale', 'permission-api']], function() {
    // User
    Route::get('/logout', 'AuthController@logout');
    Route::get('user/list', 'UserController@index');
    Route::post('user/store', 'UserController@store');
    Route::get('user/view/{id}', 'UserController@detail');
    Route::post('user/update/{id}', 'UserController@update');
    Route::post('user/update-password/{id}', 'UserController@updatePassword');
    Route::post('user/delete/{id}', 'UserController@destroy');

    // Package
    Route::get('package/list', 'PackageController@index');
    Route::post('package/store', 'PackageController@store');
    Route::post('package/update/{id}', 'PackageController@update');
    Route::get('package/view/{id}', 'PackageController@detail');
    Route::delete('package/delete/{id}', 'PackageController@destroy');

    // Package Subscription
    Route::get('package-subscription/list', 'PackageSubscriptionController@index');
    Route::post('package-subscription/store', 'PackageSubscriptionController@store');
    Route::post('package-subscription/update/{id}', 'PackageSubscriptionController@update');
    Route::get('package-subscription/view/{id}', 'PackageSubscriptionController@detail');
    Route::delete('package-subscription/delete/{id}', 'PackageSubscriptionController@destroy');

    // Role
    Route::get('role/list', 'RoleController@index');
    Route::post('role/store', 'RoleController@store');
    Route::get('role/view/{id}', 'RoleController@detail');
    Route::post('role/update/{id}', 'RoleController@update');
    Route::post('role/delete/{id}', 'RoleController@destroy');

    // Email Template
    Route::get('emailTemplate/list', 'MailTemplateController@index');
    Route::post('emailTemplate/store', 'MailTemplateController@store');
    Route::post('emailTemplate/view/{id}', 'MailTemplateController@detail');
    Route::post('emailTemplate/update/{id}', 'MailTemplateController@update');
    Route::post('emailTemplate/delete/{id}', 'MailTemplateController@destroy');

    // Sms Template
    Route::get('smsTemplate/list', 'SmsTemplateController@index');
    Route::post('smsTemplate/store', 'SmsTemplateController@store');
    Route::post('smsTemplate/view/{id}', 'SmsTemplateController@detail');
    Route::post('smsTemplate/update/{id}', 'SmsTemplateController@update');
    Route::post('smsTemplate/delete/{id}', 'SmsTemplateController@destroy');

    // Preference
    Route::match(['GET', 'POST'], 'preference', 'PreferenceController@index');

    // Email Configuration
    Route::match(['GET', 'POST'], 'emailConfiguration', 'EmailConfigurationController@index');

    // Company Setting
    Route::match(['GET', 'POST'], 'companySetting', 'CompanySettingController@index');

    // Sms Configuration
    Route::match(['GET', 'POST'], 'smsConfiguration', 'SmsConfigurationController@index');

    // Currency Converter
    Route::match(['GET', 'POST'], 'currencyConverter', 'CurrencyController@currencyConverterSetup');

    // Currency
    Route::get('currency/list', 'CurrencyController@index');
    Route::post('currency/store', 'CurrencyController@store');
    Route::post('currency/update/{id}', 'CurrencyController@update');
    Route::get('currency/view/{id}', 'CurrencyController@detail');
    Route::delete('currency/delete/{id}', 'CurrencyController@destroy');

    // Tax
    Route::get('tax/list', 'TaxController@index');
    Route::post('tax/store', 'TaxController@store');
    Route::post('tax/update/{id}', 'TaxController@update');
    Route::get('tax/view/{id}', 'TaxController@detail');

    // Brand
    Route::get('brand/list', 'BrandController@index');
    Route::post('brand/store', 'BrandController@store');
    Route::post('brand/update/{id}', 'BrandController@update');
    Route::get('brand/view/{id}', 'BrandController@detail');
    Route::post('brand/delete/{id}', 'BrandController@destroy');

    // Vendor
    Route::get('vendor/list', 'VendorController@index');
    Route::post('vendor/store', 'VendorController@store');
    Route::post('vendor/update/{id}', 'VendorController@update');
    Route::get('vendor/view/{id}', 'VendorController@detail');
    Route::post('vendor/delete/{id}', 'VendorController@destroy');

    // Item
    Route::get('items', 'ItemController@index');
    Route::post('item/store', 'ItemController@store');
    Route::post('item/update/{id}', 'ItemController@update');
    Route::post('item/search/{type}', 'ItemController@search');
    Route::get('item/view/{id}', 'ItemController@detail');
    Route::get('item/option/', 'ItemController@getItemOption');
    Route::post('item/related/update/{type}', 'ItemController@updateRealte');
    Route::post('item/delete/{id}', 'ItemController@destroy');

    // Category
    Route::get('categories', 'CategoryController@index');
    Route::post('category/store', 'CategoryController@store');
    Route::post('category/update/{id}', 'CategoryController@update');
    Route::get('category/view/{id}', 'CategoryController@detail');
    Route::post('category/delete/{id}', 'CategoryController@destroy');
});

// Country list
Route::get('country', 'CountryController@index');

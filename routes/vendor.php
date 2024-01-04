<?php

/**
 * @package vendor
 * @author techvillage <support@techvill.org>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @created 07-10-2021
 */

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

Route::group(['middleware' => ['auth', 'locale', 'permission']], function () {
    // Vendor Dashboard Routes
    Route::get('dashboard', 'DashboardController@index')->name('vendor-dashboard');

    // Vendor
    Route::get('profile', 'VendorController@profile')->name('vendor.profile');
    Route::post('profile-update/{id}', 'VendorController@update')->name('vendor.update');
    Route::post('update-password/{id}', 'VendorController@updatePassword')->name('vendor.password');
    Route::get('logout', 'VendorController@logout')->name('vendor.logout');

    // My Subscription
    Route::get('my-subscription', 'MySubscriptionController@index')->name('vendor.my_subscription.index');
    Route::get('my-subscription/pricing', 'MySubscriptionController@packageList')->name('vendor.my_subscription.pricing');
    Route::post('my-subscription/package-subscription/{id}', 'MySubscriptionController@packageSubscription')->name('vendor.my_subscription.subscription');
    Route::get('my-subscription/cancel/{id}', 'MySubscriptionController@cancelSubscription')->name('vendor.my_subscription.cancel');
    Route::get('payment/{id}', 'MySubscriptionController@paymentSubscription')->name('vendor.payment.index');
    Route::post('renew', 'MySubscriptionController@renewSubscription')->name('vendor.renew');

    // Item
    Route::get('items', 'ItemController@index')->name('vendor.items');
    Route::delete('item/delete/{id}', 'ItemController@destroy')->name('vendor.itemDestroy');
    Route::get('items/pdf', 'ItemController@pdf')->name('vendor.itemPdf');
    Route::get('items/csv', 'ItemController@csv')->name('vendor.itemCsv');
    Route::match(array('GET', 'POST'), '/item/import', 'ItemController@import')->name('vendor.item.import');

    Route::get('items/create', 'ItemController@create')->name('vendor.item.create');
    Route::post('items/store', 'ItemController@store')->name('vendor.item.store');
    Route::get('items/edit/{id}', 'ItemController@edit')->name('vendor.item.edit');
    Route::post('items/update/{id}', 'ItemController@update')->name('vendor.item.update');
    Route::post('items/search/{type}', 'ItemController@search')->name('vendor.item.search');
    Route::post('items/update-related/{type}', 'ItemController@updateRelated')->name('vendor.item.related');
    Route::get('items/view/{id}', 'ItemController@view')->name('vendor.item.view');
    Route::post('items/get-item-option', 'ItemController@getItemOption');
    Route::post('attributes/get-attribute', 'ItemController@getAttribute');
    Route::post('options/get-option', 'ItemController@getOption');

    // Review
    Route::get('reviews', 'ReviewController@index')->name('vendor.reviews');
    Route::post('reviews/edit', 'ReviewController@edit')->name('vendor.reviewEdit');
    Route::get('reviews/view/{id}', 'ReviewController@view')->name('vendor.reviewView');
    Route::post('reviews/update', 'ReviewController@update')->name('vendor.reviewUpdate');
    Route::post('reviews/delete/{id}', 'ReviewController@destroy')->name('vendor.reviewDestroy');
    Route::get('reviews/pdf', 'ReviewController@pdf')->name('vendor.reviewPdf');
    Route::get('reviews/csv', 'ReviewController@csv')->name('vendor.reviewCsv');

    // Order
    Route::get('orders', 'VendorOrderController@index')->name('vendorOrder.index');
    Route::get('orders/view/{id}', 'VendorOrderController@view')->name('vendorOrder.view');
    Route::post('orders/change-status', 'VendorOrderController@changeStatus');
    Route::get('orders/pdf', 'VendorOrderController@pdf')->name('vendorOrder.pdf');
    Route::get('orders/csv', 'VendorOrderController@csv')->name('vendorOrder.csv');
    Route::get('invoice/print/{id}', 'VendorOrderController@invoicePrint')->name('vendorInvoice.print');

    // Withdrawal
    Route::get('withdrawals', 'WithdrawalController@index')->name('vendorWithdrawal.index');
    Route::match(['get', 'post'], 'withdrawal/setting', 'WithdrawalController@setting')->name('vendorWithdrawal.setting');
    Route::match(['get', 'post'], 'withdraw/money', 'WithdrawalController@withdraw')->name('vendorWithdrawal.money');
    Route::get('withdrawals/pdf', 'WithdrawalController@pdf')->name('vendorWithdrawal.pdf');
    Route::get('withdrawals/csv', 'WithdrawalController@csv')->name('vendorWithdrawal.csv');

    // Transactions
    Route::get('transactions', 'VendorTransactionController@index')->name('vendorTransaction.index');
    Route::get('transactions/pdf', 'VendorTransactionController@pdf')->name('vendorTransaction.pdf');
    Route::get('transactions/csv', 'VendorTransactionController@csv')->name('vendorTransaction.csv');

    Route::name('vendor.')->group(function () {
        Route::get('/user/{uid}/getinfo', 'DashboardController@getUserData')->name('users.user-data');
        Route::get('/item/{uid}/getinfo', 'DashboardController@getItemData')->name('items.item-data');
        Route::get('/get-most-sold-products', 'DashboardController@mostSoldProducts')->name('dashboard.most-sold-products');
        Route::get('/get-active-users', 'DashboardController@mostActiveUsers')->name('dashboard.most-active-users');
        Route::get('/vendor-stats', 'DashboardController@vendorStats')->name('dashboard.vendor-stats');
        Route::get('/sales-of-the-month', 'DashboardController@salesOfTheMonth')->name('dashboard.sales-of-this-month');
    });
});

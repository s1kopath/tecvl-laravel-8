<?php

/**
 * @package web
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 20-05-2021
 * @modified 06-09-2021
 */


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

Route::get('/', 'LoginController@showLoginForm');
Route::get('/login', 'LoginController@showLoginForm')->name('login');
Route::post('/authenticate', 'LoginController@authenticate')->name('login.post');

// Password reset
Route::get('password/resets/{token}', 'LoginController@showResetForm')->name('password.reset');
Route::post('password/resets', 'LoginController@setPassword')->name('password.resets');
Route::post('password/email', 'LoginController@sendResetLinkEmail')->name('login.sendResetLink');
Route::get('password/reset', 'LoginController@reset')->name('login.reset');
Route::get('password/reset-otp', 'LoginController@resetOtp')->name('reset.otp');

Route::get('/impersonate/{impersonate}', 'LoginController@impersonate')->name('impersonator');

Route::get('/cancel-impersonate', 'LoginController@cancelImpersonate')->name('impersonator-cancel');


Route::get('customer', [App\Http\Controllers\CustomerAuth\LoginController::class, 'showLoginForm']);
Route::get('/logout', 'LoginController@logout')->name('users.logout');

Route::group(['middleware' => ['auth', 'locale', 'permission']], function () {
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');

        \Session::flash('success', __('Cache successfully cleared.'));

        return back();
    })->name('clear-cache');

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Role
    Route::get('role/list', 'RoleController@index')->name('roles.index');
    Route::get('role/create', 'RoleController@create')->name('roles.create');
    Route::post('role/store', 'RoleController@store')->name('roles.store');
    Route::get('role/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::post('role/update/{id}', 'RoleController@update')->name('roles.update');
    Route::post('role/delete/{id}', 'RoleController@destroy')->name('roles.destroy');

    // Role
    Route::get('permission-role', 'PermissionRoleController@index')->name('permissionRoles.index');
    Route::get('generate-permission', 'PermissionRoleController@generatePermission')->name('generatePermission.index');
    Route::post('assign-permission', 'PermissionRoleController@assignPermission')->name('permissionRoles.assignPermission');

    // User
    Route::get('user/list', 'UserController@index')->name('users.index');
    Route::get('user/create', 'UserController@create')->name('users.create');
    Route::post('user/store', 'UserController@store')->name('users.store');
    Route::get('user/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('user/updatePassword/{id}', 'UserController@updatePassword')->name('users.password');
    Route::post('user/update/{id}', 'UserController@update')->name('users.update');
    Route::post('user/delete/{id}', 'UserController@destroy')->name('users.destroy');
    Route::match(array('GET', 'POST'), 'user/import', 'UserController@import')->name('users.import');
    Route::get('user/pdf', 'UserController@pdf')->name('users.pdf');
    Route::get('user/csv', 'UserController@csv')->name('users.csv');
    Route::get('user/wallet/{id}', 'UserController@wallet')->name('user.wallet');

    Route::post('user/update-profile/{id}', 'UserController@updateProfile')->name('users.updateProfile');
    Route::get('profile', 'UserController@profile')->name('users.profile');
    Route::post('user/update-profile-password/{id}', 'UserController@updateProfilePassword')->name('users.profilePassword');

    // Item
    Route::get('items', 'ItemController@index')->name('item.index');
    Route::get('items/create', 'ItemController@create')->name('item.create');
    Route::post('items/store', 'ItemController@store')->name('item.store');
    Route::get('items/edit/{id}', 'ItemController@edit')->name('item.edit');
    Route::get('items/view/{id}', 'ItemController@view')->name('item.view');
    Route::post('items/search/{type}', 'ItemController@search')->name('item.search');
    Route::post('items/get-item-option', 'ItemController@getItemOption');
    Route::post('items/update/{id}', 'ItemController@update')->name('item.update');
    Route::post('items/update-related/{type}', 'ItemController@updateRealted')->name('item.related');
    Route::delete('items/delete/{id}', 'ItemController@destroy')->name('item.destroy');
    Route::get('items/pdf', 'ItemController@pdf')->name('item.pdf');
    Route::get('items/csv', 'ItemController@csv')->name('item.csv');
    Route::match(array('GET', 'POST'), '/item/import', 'ItemController@import')->name('item.import');
    Route::post('items/seo', 'ItemController@seoStoreOrUpdate')->name('item.seo');

    // Files Upload
    Route::post('file/upload', 'FilesController@uploadEventAttachments');
    Route::post('file/remove', 'FilesController@deleteEventAttachment');
    Route::get('is-valid-file-size', 'FilesController@isValidFileSize');

    // Vendor Admin Routes
    Route::get('vendors', 'VendorController@index')->name('vendors.index');
    Route::get('vendors/create', 'VendorController@create')->name('vendors.create');
    Route::post('vendors/store', 'VendorController@store')->name('vendors.store');
    Route::get('vendors/edit/{id}', 'VendorController@edit')->name('vendors.edit');
    Route::post('vendors/update/{id}', 'VendorController@update')->name('vendors.update');
    Route::post('vendors/delete/{id}', 'VendorController@destroy')->name('vendors.destroy');
    Route::match(array('GET', 'POST'), 'vendors/import', 'VendorController@import')->name('vendors.import');
    Route::get('vendors/pdf', 'VendorController@pdf')->name('vendors.pdf');
    Route::get('vendors/csv', 'VendorController@csv')->name('vendors.csv');

    // Brand
    Route::get('brands', 'BrandController@index')->name('brands.index');
    Route::get('brands/create', 'BrandController@create')->name('brands.create');
    Route::post('brands/store', 'BrandController@store')->name('brands.store');
    Route::get('brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
    Route::post('brands/update/{id}', 'BrandController@update')->name('brands.update');
    Route::post('brands/delete/{id}', 'BrandController@destroy')->name('brands.destroy');
    Route::get('brands/pdf', 'BrandController@pdf')->name('brands.pdf');
    Route::get('brands/csv', 'BrandController@csv')->name('brands.csv');

    // Attribute
    Route::get('attributes', 'AttributeController@index')->name('attribute.index');
    Route::get('attributes/create', 'AttributeController@create')->name('attribute.create');
    Route::post('attributes/store', 'AttributeController@store')->name('attribute.store');
    Route::get('attributes/edit/{id}', 'AttributeController@edit')->name('attribute.edit');
    Route::post('attributes/get-attribute', 'AttributeController@getAttribute');
    Route::post('attributes/update/{id}', 'AttributeController@update')->name('attribute.update');
    Route::delete('attributes/delete/{id}', 'AttributeController@destroy')->name('attribute.destroy');
    Route::get('attributes/pdf', 'AttributeController@pdf')->name('attribute.pdf');
    Route::get('attributes/csv', 'AttributeController@csv')->name('attribute.csv');

    // Attribute Group
    Route::get('attribute-groups', 'AttributeGroupController@index')->name('attributeGroup.index');
    Route::get('attribute-groups/create', 'AttributeGroupController@create')->name('attributeGroup.create');
    Route::post('attribute-groups/store', 'AttributeGroupController@store')->name('attributeGroup.store');
    Route::get('attribute-groups/edit/{id}', 'AttributeGroupController@edit')->name('attributeGroup.edit');
    Route::post('attribute-groups/update/{id}', 'AttributeGroupController@update')->name('attributeGroup.update');
    Route::delete('attribute-groups/delete/{id}', 'AttributeGroupController@destroy')->name('attributeGroup.destroy');
    Route::get('attribute-groups/pdf', 'AttributeGroupController@pdf')->name('attributeGroup.pdf');
    Route::get('attribute-groups/csv', 'AttributeGroupController@csv')->name('attributeGroup.csv');

    // Options
    Route::get('options', 'OptionController@index')->name('option.index');
    Route::get('options/create', 'OptionController@create')->name('option.create');
    Route::post('options/store', 'OptionController@store')->name('option.store');
    Route::get('options/edit/{id}', 'OptionController@edit')->name('option.edit');
    Route::post('options/get-option', 'OptionController@getOption');
    Route::put('options/update/{id}', 'OptionController@update')->name('option.update');
    Route::delete('options/delete/{id}', 'OptionController@destroy')->name('option.destroy');
    Route::get('options/pdf', 'OptionController@pdf')->name('option.pdf');
    Route::get('options/csv', 'OptionController@csv')->name('option.csv');

    // Category
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::post('categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('categories/get-data', 'CategoryController@getData');
    Route::post('categories/get-parent-data', 'CategoryController@getParentData');
    Route::post('categories/move-node', 'CategoryController@moveNode');
    Route::post('categories/edit', 'CategoryController@edit');
    Route::post('categories/update', 'CategoryController@update')->name('categories.update');
    Route::post('categories/delete', 'CategoryController@destroy')->name('categories.destroy');

    // Email Template
    Route::get('emailTemplate/list', 'MailTemplateController@index')->name('emailTemplates.index');
    Route::get('emailTemplate/create', 'MailTemplateController@create')->name('emailTemplates.create');
    Route::post('emailTemplate/store', 'MailTemplateController@store')->name('emailTemplates.store');
    Route::get('emailTemplate/edit/{id}', 'MailTemplateController@edit')->name('emailTemplates.edit');
    Route::post('emailTemplate/update/{id}', 'MailTemplateController@update')->name('emailTemplates.update');
    Route::post('emailTemplate/delete/{id}', 'MailTemplateController@destroy')->name('emailTemplates.destroy');

    // SMS Template
    Route::get('smsTemplate/list', 'SmsTemplateController@index')->name('smsTemplates.index');
    Route::get('smsTemplate/create', 'SmsTemplateController@create')->name('smsTemplates.create');
    Route::post('smsTemplate/store', 'SmsTemplateController@store')->name('smsTemplates.store');
    Route::get('smsTemplate/edit/{id}', 'SmsTemplateController@edit')->name('smsTemplates.edit');
    Route::post('smsTemplate/update/{id}', 'SmsTemplateController@update')->name('smsTemplates.update');
    Route::post('smsTemplate/delete/{id}', 'SmsTemplateController@destroy')->name('smsTemplates.destroy');

    // Preference
    Route::match(['GET', 'POST'], 'preference', 'PreferenceController@index')->name('preferences.index');
    Route::match(['GET', 'POST'], 'preference/password', 'PreferenceController@password')->name('preferences.password');

    // Email Configuration
    Route::match(['GET', 'POST'], 'emailConfiguration', 'EmailConfigurationController@index')->name('emailConfigurations.index');

    // Company Settings
    Route::match(['GET', 'POST'], 'company/setting', 'CompanySettingController@index')->name('companyDetails.setting');
    Route::post('company/image-delete', 'CompanySettingController@deleteImage');
    Route::post('company/icon-delete', 'CompanySettingController@deleteIcon');

    // Language
    Route::get('languages/translation/{id}', 'LanguageController@translation')->name('language.translation');
    Route::get('languages', 'LanguageController@index')->name('language.index');
    Route::post('languages/save', 'LanguageController@store')->name('language.store');
    Route::post('languages/edit', 'LanguageController@edit');
    Route::post('languages/update', 'LanguageController@update')->name('language.update');
    Route::post('languages/delete/{id}', 'LanguageController@delete')->name('language.delete');
    Route::post('languages/translation/save', 'LanguageController@translationStore')->name('language.translationSave');

    // Currency
    Route::get('currencies', 'CurrencyController@index')->name('currency.index');
    Route::post('currencies/save', 'CurrencyController@store')->name('currency.store');
    Route::post('currencies/edit', 'CurrencyController@edit')->name('currency.edit');
    Route::post('currencies/update', 'CurrencyController@update')->name('currency.update');
    Route::post('currencies/delete/{id}', 'CurrencyController@destroy')->name('currency.delete');
    Route::get('currencies/valid', 'CurrencyController@validCurrencyName');

    // Tax
    Route::get('taxes', 'TaxController@index')->name('tax.index');
    Route::post('taxes/save', 'TaxController@store')->name('tax.store');
    Route::post('taxes/edit', 'TaxController@edit')->name('tax.edit');
    Route::put('taxes/update', 'TaxController@update')->name('tax.update');
    Route::post('tax/delete/{id}', 'TaxController@destroy')->name('tax.delete');

    // Package
    Route::get('package', 'PackageController@index')->name('package.index');
    Route::get('package/create', 'PackageController@create')->name('package.create');
    Route::post('package/store', 'PackageController@store')->name('package.store');
    Route::get('package/edit/{id}', 'PackageController@edit')->name('package.edit');
    Route::post('package/update/{id}', 'PackageController@update')->name('package.update');
    Route::post('package/delete/{id}', 'PackageController@destroy')->name('package.destroy');
    Route::get('package/pdf', 'PackageController@pdf')->name('package.pdf');
    Route::get('package/csv', 'PackageController@csv')->name('package.csv');

    // Package Subscription
    Route::get('package-subscription', 'PackageSubscriptionController@index')->name('packageSubscription.index');
    Route::get('package-subscription/create', 'PackageSubscriptionController@create')->name('packageSubscription.create');
    Route::post('package-subscription/store', 'PackageSubscriptionController@store')->name('packageSubscription.store');
    Route::get('package-subscription/show/{id}', 'PackageSubscriptionController@show')->name('packageSubscription.show');
    Route::get('package-subscription/edit/{id}', 'PackageSubscriptionController@edit')->name('packageSubscription.edit');
    Route::post('package-subscription/update/{id}', 'PackageSubscriptionController@update')->name('packageSubscription.update');
    Route::post('package-subscription/delete/{id}', 'PackageSubscriptionController@destroy')->name('packageSubscription.destroy');
    Route::get('package-subscription/pdf', 'PackageSubscriptionController@pdf')->name('packageSubscription.pdf');
    Route::get('package-subscription/csv', 'PackageSubscriptionController@csv')->name('packageSubscription.csv');

    // SMS Setup
    Route::match(['GET', 'POST'], 'sms-configuration', 'SmsConfigurationController@index')->name('smsConfiguration.index');

    // Currency Converter
    Route::match(['GET', 'POST'], 'currency-converter', 'CurrencyController@currencyConverterSetup')->name('currency.convert');

    // Review
    Route::get('reviews', 'ReviewController@index')->name('review.index');
    Route::post('reviews/edit', 'ReviewController@edit')->name('review.edit');
    Route::get('reviews/view/{id}', 'ReviewController@view')->name('review.view');
    Route::post('reviews/update', 'ReviewController@update')->name('review.update');
    Route::post('reviews/delete/{id}', 'ReviewController@destroy')->name('review.destroy');
    Route::get('reviews/pdf', 'ReviewController@pdf')->name('review.pdf');
    Route::get('reviews/csv', 'ReviewController@csv')->name('review.csv');

    // SSO Service
    Route::match(['GET', 'POST'], 'sso-service', 'SsoController@index')->name('sso.index');

    // Maintainance mode
    Route::match(['GET', 'POST'], 'maintenance-mode', 'MaintenanceModeController@enable')->name('maintenance.enable');

    // Order status
    Route::get('order-statuses', 'OrderStatusController@index')->name('orderStatues.index');
    Route::post('order-statuses/save', 'OrderStatusController@store')->name('orderStatues.store');
    Route::post('order-statuses/edit', 'OrderStatusController@edit');
    Route::post('order-statuses/update', 'OrderStatusController@update')->name('orderStatues.update');
    Route::post('order-statuses/delete/{id}', 'OrderStatusController@destroy')->name('orderStatues.delete');

    // Order
    Route::get('orders', 'AdminOrderController@index')->name('order.index');
    Route::get('orders/view/{id}', 'AdminOrderController@view')->name('order.view');
    Route::post('orders/change-status', 'AdminOrderController@changeStatus');
    Route::post('orders/update', 'AdminOrderController@update');
    Route::delete('orders/delete/{id}', 'AdminOrderController@destroy')->name('order.destroy');
    Route::get('orders/pdf', 'AdminOrderController@pdf')->name('order.pdf');
    Route::get('orders/csv', 'AdminOrderController@csv')->name('order.csv');
    Route::get('invoice/print/{id}', 'AdminOrderController@invoicePrint')->name('invoice.print');

    // Transaction
    Route::get('transactions', 'TransactionController@index')->name('transaction.index');
    Route::get('transaction/edit/{id}', 'TransactionController@edit')->name('transaction.edit');
    Route::post('transaction/update/{id}', 'TransactionController@update')->name('transaction.update');
    Route::get('transactions/pdf', 'TransactionController@pdf')->name('transaction.pdf');
    Route::get('transactions/csv', 'TransactionController@csv')->name('transaction.csv');

    // Withdrawal
    Route::get('withdrawals', 'WithdrawalController@index')->name('withdrawal.index');
    Route::get('withdrawal/edit/{id}', 'WithdrawalController@edit')->name('withdrawal.edit');
    Route::post('withdrawal/update/{id}', 'WithdrawalController@update')->name('withdrawal.update');
    Route::get('withdrawals/pdf', 'WithdrawalController@pdf')->name('withdrawal.pdf');
    Route::get('withdrawals/csv', 'WithdrawalController@csv')->name('withdrawal.csv');

    // Addons Manager
    Route::get('addons', 'AddonsMangerController@index')->name('addon.index');

    // Withdrawal setting
    Route::get('withdrawal-setting', 'WithdrawalController@setting')->name('withdrawalSetting.index');
    Route::post('withdrawal-setting/update', 'WithdrawalController@updateSetting')->name('withdrawalSetting.update');



    // Dashboard route
    Route::get('/user/{uid}/getinfo', 'DashboardController@getUserData')->name('users.user-data');
    Route::get('/item/{uid}/getinfo', 'DashboardController@getItemData')->name('items.item-data');
    Route::get('/get-most-sold-products', 'DashboardController@mostSoldProducts')->name('dashboard.most-sold-products');
    Route::get('/get-active-users', 'DashboardController@mostActiveUsers')->name('dashboard.most-active-users');
    Route::get('/vendor-stats', 'DashboardController@vendorStats')->name('dashboard.vendor-stats');
    Route::get('/vendor-stats/{type}', 'DashboardController@vendorStatsType')->name('dashboard.vendor-stats-type');
    Route::get('/vendor-req', 'DashboardController@vendorReq')->name('dashboard.vendor-req');
    Route::get('/sales-of-the-month', 'DashboardController@salesOfTheMonth')->name('dashboard.sales-of-this-month');
    Route::get('user/change-status/{status}/{id}', 'DashboardController@changeStatus')->name('dashboard.changeStatus');

    // Email
    Route::match(['GET', 'POST'], 'verify-email-setting', 'EmailController@emailVerifySetting')->name('emailVerifySetting');

    // Product Setting
    Route::match(['GET', 'POST'], 'product-setting', 'ProductSettingController@general')->name('product.setting.general');
    Route::post('product-setting/inventory', 'ProductSettingController@inventory')->name('product.setting.inventory');
    Route::post('product-setting/vendor', 'ProductSettingController@vendor')->name('product.setting.vendor');
});

Route::group(['middleware' => ['isLoggedIn']], function () {
    Route::get('files/download/{id}', 'FilesController@downloadAttachment');
    Route::post('change-lang', 'DashboardController@switchLanguage');
});

Route::get('user/verify/{code}', 'UserController@verification')->name('users.verify');

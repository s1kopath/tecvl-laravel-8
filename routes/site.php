<?php

/**
 * @package site
 * @author techvillage <support@techvill.org>
 * @contributor Sakawat Hossain Rony <[sakawat.techvill@gmail.com]>
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 * @created 07-11-2021
 * @modified 19-12-2021
 */
/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// homepage
Route::group(['middleware' => ['locale']], function () {
    Route::get('/', 'SiteController@index')->name('site.index');
    Route::post('review/pagination/fetch', 'SiteController@fetch')->name('fetch.review');
    Route::post('change-language', 'DashboardController@switchLanguage');

    Route::get('shop/{alias}', 'SellerController@index')->name('site.shop');
    Route::get('shop/{alias}/all', 'SellerController@allItem')->name('site.shopAll');
    Route::get('shop/profile/{alias}', 'SellerController@vendorProfile')->name('site.shop.profile');

    // login register
    Route::get('login', 'LoginController@login');
    Route::get('user/login', 'LoginController@login')->name('site.login');
    Route::post('authenticate', 'LoginController@authenticate')->name('site.authenticate');
    Route::get('user-verify/{code}', 'LoginController@verification')->name('site.verify');
    Route::get('sign-up', 'LoginController@showSignUpform')->name('site.signUp');
    Route::post('sign-up-store', 'LoginController@signUp')->name('site.signUpStore');
    Route::get('user/logout', 'LoginController@logout')->name('site.logout');
    Route::get('check-email-existence/{email}', 'LoginController@checkEmailExistence');

    // Password reset
    Route::get('password/resets/{token}', 'LoginController@showResetForm')->name('site.password.reset');
    Route::post('password/resets', 'LoginController@setPassword')->name('site.password.resets');
    Route::post('password/email', 'LoginController@sendResetLinkEmail')->name('site.login.sendResetLink');
    Route::get('password/reset', 'LoginController@reset')->name('site.login.reset');
    Route::get('password/reset-otp', 'LoginController@resetOtp')->name('site.reset.otp');
    Route::get('verification/otp', 'LoginController@verificationOtp')->name('site.verification.otp');
    Route::post('verification/token', 'LoginController@userVerification')->name('site.user.verification');

});

// login or register by google
Route::get('login/google', 'LoginController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'LoginController@handelGoogleCallback')->name('google');

// login or register by facebook
Route::get('login/facebook', 'LoginController@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'LoginController@handelFacebookCallback')->name('facebook');

Route::group(['middleware' => ['site.auth', 'locale', 'permission']], function () {

    // dashboard
    Route::get('user/dashboard', 'DashboardController@index')->name('site.dashboard');
    Route::get('user/hide-welcome-message', 'DashboardController@removeWelcome');
    // user
    Route::get('user/profile', 'UserController@edit')->name('site.userProfile');
    Route::post('user/profile/update', 'UserController@update')->name('site.userProfileUpdate');
    Route::get('user/profile/edit-password', 'UserController@editPassword')->name('site.userProfileEditPassword');
    Route::post('user/profile/update-password', 'UserController@updatePassword')->name('site.userProfileUpdatePassword');
    Route::get('user/setting', 'UserController@setting')->name('site.userSetting');
    Route::post('user/delete/', 'UserController@destroy')->name('site.userDelete');
    Route::get('user/orders', 'OrderController@index')->name('site.order');
    Route::get('user/order-details/{reference}', 'OrderController@orderDetails')->name('site.orderDetails');
    Route::get('user/profile/remove-image', 'UserController@removeImage')->name('site.userProfileDelete');

    // Wishlist
    Route::get('user/wishlists', 'WishlistController@index')->name('site.wishlist');
    Route::post('user/wishlist/store', 'WishlistController@store')->name('site.wishlistStore');
    Route::post('user/wishlist/delete/{id}', 'WishlistController@destroy')->name('wishlist.destroy');

    // Order
    Route::post('order', 'OrderController@store')->name('site.orderStore');
    Route::get('order-confirm/{reference}', 'OrderController@confirmation')->name('site.orderConfirm');
    Route::get('order-paid/', 'OrderController@orderPaid')->name('site.orderpaid');

    // Check Out
    Route::get('checkout', 'OrderController@checkOut')->name('site.checkOut');

    // Address
    Route::get('user/addresses', 'AddressController@index')->name('site.address');
    Route::get('user/address/create', 'AddressController@create')->name('site.addressCreate');
    Route::post('user/address/store', 'AddressController@store')->name('site.addressStore');
    Route::get('user/address/edit/{id}', 'AddressController@edit')->name('site.addressEdit');
    Route::post('user/address/update/{id}', 'AddressController@update')->name('site.addressUpdate');
    Route::post('user/address/delete/{id}', 'AddressController@destroy')->name('site.addressDelete');
    Route::post('user/check-default-address', 'AddressController@checkDefault');
    Route::get('user/make-default-address/{id}', 'AddressController@makeDefault')->name('address.makeDefault');


    // review
    Route::post('/site/review/update', 'SiteController@updateReview');
    Route::post('/user/review-store', 'SiteController@reviewStore')->name('site.reviewStore');
    Route::get('/user/reviews', 'ReviewController@index')->name('site.review');
    Route::post('/user/review/delete/{id}', 'ReviewController@destroy')->name('site.review.destroy');
    Route::post('/site/review/destroy', 'SiteController@deleteReview');
});

// Review
Route::post('site/review/filter', 'SiteController@filterReview');

// item
Route::get('items/{code}/{name}', 'SiteController@itemDetails')->name('site.itemDetails');

// Blog
Route::get('blog/list/{value?}', 'SiteController@allBlogs')->name('blog.all');
Route::get('blog/search', 'SiteController@blogSearch')->name('blog.search');
Route::get('blog/details/{slug}', 'SiteController@blogDetails')->name('blog.details');
Route::get('blog-category/{id}', 'SiteController@blogCategory')->name('blog.category');

// Categories
Route::get('categories/{slug}/items', 'SiteController@categoryItems')->name('site.categoryItems');

// Brands
Route::get('brand/{id}/items', 'SiteController@brandItems')->name('site.brandItems');

// cart
Route::get('carts', 'CartController@index')->name('site.cart');
Route::post('cart-store', 'CartController@store')->name('site.addCart');
Route::post('cart-reduce-qty', 'CartController@reduceQuantity')->name('site.cartReduceQuantity');
Route::post('cart-delete', 'CartController@destroy')->name('site.delete');
Route::post('cart-selected-delete', 'CartController@destroySelected');
Route::post('cart-selected-store', 'CartController@storeSelected');
Route::post('cart-all-delete', 'CartController@destroyAll');

// check coupon
Route::post('check-coupon', 'CartController@checkCoupon')->name('site.checkCoupon');

// filter
Route::post('filter-items', 'SiteController@filter');

// search
Route::get('search-items', 'SiteController@search')->name('site.searchByKeyWord');

// compare
Route::get('/compare', 'CompareController@index')->name('site.compare');
Route::post('/compare-store', 'CompareController@store')->name('site.addCompare');
Route::post('/compare-delete', 'CompareController@destroy')->name('site.compareDestroy');

// Track order
Route::match(['get', 'post'], '/track-order', 'OrderController@track')->name('site.trackOrder');

// Get Stock
Route::post('get-stock', 'SiteController@getStock')->name('site.getStock');

Route::get('item/quick-view/{id}', 'SiteController@quickView')->name('quickView');

// Notification
Route::view('user/notification', 'site.notification.notification');

Route::get('user/order-manage', 'OrderController@orderManage')->name('site.orderManage');
// be a seller
Route::get('seller/be-a-seller', 'beASellerController@beSeller');
Route::get('seller/seller-registration', 'beASellerController@sellerRegistration')->name('site.seller-registration');
// coupon
Route::get('/coupon', 'SiteController@coupon');

// Pages
Route::get('{slug}', 'SiteController@page')->name('site.page');

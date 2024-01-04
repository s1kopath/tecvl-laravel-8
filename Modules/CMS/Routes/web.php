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

use Modules\CMS\Http\Controllers\BuilderController;

Route::group(['middleware' => ['auth', 'locale', 'permission']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('page/list', 'CMSController@index')->name('page.index');
        Route::get('/page/home/list', 'CMSController@home')->name('page.home');
        Route::get('page/create', 'CMSController@create')->name('page.create');
        Route::get('page/home/create', 'CMSController@createHomepage')->name('page.home.create');
        Route::post('page/store', 'CMSController@store')->name('page.store');
        Route::get('page/edit/{slug}', 'CMSController@edit')->name('page.edit');
        Route::get('page/home/edit/{slug}', 'CMSController@editHome')->name('page.home.edit');
        Route::post('page/update/{id}', 'CMSController@update')->name('page.update');
        Route::post('page/delete/{id}', 'CMSController@delete')->name('page.delete');

        // Theme Option
        Route::get('theme/list', 'ThemeOptionController@list')->name('theme.index');
        Route::post('theme/store', 'ThemeOptionController@store')->name('theme.store');

        // Slide
        Route::get('slide/create', 'SlideController@create')->name('slide.create');
        Route::post('slide/store', 'SlideController@store')->name('slide.store');
        Route::get('slide/edit/{id}', 'SlideController@edit')->name('slide.edit');
        Route::post('slide/update/{id}', 'SlideController@update')->name('slide.update');
        Route::post('slide/delete/{id}', 'SlideController@delete')->name('slide.delete');

        // Slider
        Route::get('sliders', 'SliderController@index')->name('slider.index');
        Route::post('slider/store', 'SliderController@store')->name('slider.store');
        Route::post('slider/update', 'SliderController@update')->name('slider.update');
        Route::post('slider/delete/{id}', 'SliderController@delete')->name('slider.delete');

        // Page builder
        Route::get('page/builder/{slug}', [BuilderController::class, 'edit'])->name('builder.edit');
        Route::match(['get', 'post'], 'page/builder/edit/{file}', [BuilderController::class, 'editElement'])->name('builder.form');
        Route::post('page/builder/edit/{id}/component', [BuilderController::class, 'updateComponent'])->name('builder.update');
        Route::post('page/builder/remove/{id}/component', [BuilderController::class, 'deleteComponent'])->name('builder.delete');
        Route::post('page/builder/order/{id}/component', [BuilderController::class, 'orderComponent'])->name('builder.order');
    });
});

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

Route::group(['middleware' => ['auth', 'locale', 'permission']], function () {
    // Popup
    Route::get('popups', 'PopupController@index')->name('popup.index');
    Route::get('popup/create', 'PopupController@create')->name('popup.create');
    Route::get('popup/show/{id}', 'PopupController@show')->name('popup.show');
    Route::post('popup/store', 'PopupController@store')->name('popup.store');
    Route::get('popup/edit/{id}', 'PopupController@edit')->name('popup.edit');
    Route::post('popup/update/{id}', 'PopupController@update')->name('popup.update');
    Route::post('popup/delete/{id}', 'PopupController@destroy')->name('popup.delete');
    Route::get('popups/pdf', 'PopupController@pdf')->name('popup.pdf');
    Route::get('popups/csv', 'PopupController@csv')->name('popup.csv');

});

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
        Route::get('uploaded-files/create', 'MediaManagerController@create')->name('mediaManager.create');
        Route::post('uploaded-files/store', 'MediaManagerController@store')->name('mediaManager.store');
        Route::post('upload/image', 'MediaManagerController@upload')->name('mediaManager.upload');
        Route::get('uploaded-files', 'MediaManagerController@uploadedFiles')->name('mediaManager.uplodedFiles');
        Route::get('sort-files', 'MediaManagerController@sortFiles')->name('mediaManager.sortFiles');
        Route::get('paginate-files', 'MediaManagerController@paginateFiles')->name('mediaManager.paginateFiles');
        Route::get('uploaded-files/download/{id}', 'MediaManagerController@download')->name('mediaManager.download');
        Route::get('max-fileid', 'MediaManagerController@maxFileId')->name('mediaManager.maxId');
        Route::post('paginate-data', 'MediaManagerController@paginateData')->name('mediaManager.paginateData');
        Route::post('delete-image', 'MediaManagerController@deleteImage')->name('mediaManager.delete');
    });
});

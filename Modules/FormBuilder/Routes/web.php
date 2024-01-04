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

use Modules\FormBuilder\Http\Controllers\FormController;
use Modules\FormBuilder\Http\Controllers\KycController;
use Modules\FormBuilder\Http\Controllers\SubmissionController;

Route::prefix('admin/form-builder')->as('formbuilder::')->group(function () {

    Route::get('/', [FormController::class, 'index']);

    /**
     * Public form url
     */
    Route::get('/form/{identifier}', 'RenderFormController@render')->name('form.render');
    Route::post('/form/{identifier}', 'RenderFormController@submit')->name('form.submit');
    Route::get('/form/feedback/{identifier}', 'RenderFormController@feedback')->name('form.feedback');

    /**
     * My submission routes
     */
    Route::resource('/my-submissions', 'MySubmissionController');


    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.all');
    /**
     * Form submission management routes
     */
    Route::prefix('/forms/{fid}')->group(function () {
        Route::resource('/submissions', 'SubmissionController');
    });

    /**
     * Form management routes
     */
    Route::resource('/forms', 'FormController');

    Route::name('kyc.')->group(function () {
        Route::get('kyc-form', [KycController::class, 'index'])->name('index');
        Route::get('kyc/edit/{form}', [KycController::class, 'edit'])->name('edit');
        Route::put('kyc/edit/{form}', [KycController::class, 'update'])->name('update');
        Route::get('kyc/submission/edit/{id}', [KycController::class, 'editSubmission'])->name('sub-edit');
        Route::put('kyc/submission/edit/{id}', [KycController::class, 'editSubmission'])->name('sub-update');
        Route::get('kyc/submission/{id}', [KycController::class, 'viewSubmission'])->name('sub-view');
        Route::delete('/kyc/delete/{id}', [KycController::class, 'submissionDelete'])->name('delete');
    });
});

Route::prefix('vendor')->as('kyc.user.')->group(function () {
    Route::get('/kyc', [KycController::class, 'userKycForm'])->name('show');
    Route::post('/kyc/submit/{identifier}', [KycController::class, 'userKycSubmit'])->name('submit');
    Route::put('/kyc/update-submission/{id}', [KycController::class, 'userKycUpdateSubmission'])->name('update');
});

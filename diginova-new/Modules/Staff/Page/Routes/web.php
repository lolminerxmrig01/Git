<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Page\Http\Controllers\StaffPageController;

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

Route::domain('staff.diginova.test')->prefix('pages')->name('staff.pages.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffPageController::class, 'index'])
        ->name('index');

    Route::post('filter', [StaffPageController::class, 'filterByType'])
        ->name('filterByType');

    Route::post('brand-search', [StaffPageController::class, 'brandSearch'])
        ->name('brandSearch');

    Route::post('brand-cat-search', [StaffPageController::class, 'brandCatSearch'])
        ->name('brandCatSearch');

    Route::post('ajax-pagination', [StaffPageController::class, 'ajaxPagination'])
        ->name('ajaxPagination');

    Route::get('create', [StaffPageController::class, 'create'])
        ->name('create');

    Route::post('store', [StaffPageController::class, 'store'])
        ->name('store');

    Route::get('edit/{id}', [StaffPageController::class, 'edit'])
        ->name('edit');

    Route::post('update', [StaffPageController::class, 'update'])
        ->name('update');

    Route::post('delete', [StaffPageController::class, 'moveToTrash'])
        ->name('moveToTrash');

    Route::get('trash', [StaffPageController::class, 'trash'])
        ->name('trash');

    Route::post('trash-pagination', [StaffPageController::class, 'trashPagination'])
        ->name('trashPagination');

    Route::post('force-delete', [StaffPageController::class, 'removeFromTrash'])
        ->name('removeFromTrash');

    Route::post('restore', [StaffPageController::class, 'restoreFromTrash'])
        ->name('restoreFromTrash');

    Route::post('ajaxupload', [StaffPageController::class, 'uploadImage'])
        ->name('ajaxupload');

    Route::post('upload-update', [StaffPageController::class, 'uploadUpdate'])
        ->name('uploadUpdate');

    Route::post('ajaxdelete', [StaffPageController::class, 'deleteImage'])
    ->name('ajaxdelete');

});
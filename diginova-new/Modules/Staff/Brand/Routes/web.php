<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Brand\Http\Controllers\StaffBrandController;

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

Route::domain('staff.diginova.test')->prefix('brands')->name('staff.brands.')
    ->middleware('web', 'staff')->group(function () {

        Route::get('/', [StaffBrandController::class, 'index'])
            ->name('index');

        Route::post('filter', [StaffBrandController::class, 'filterByType'])
            ->name('filterByType');

        Route::post('brand-search', [StaffBrandController::class, 'brandSearch'])
            ->name('brandSearch');

        Route::post('brand-cat-search', [StaffBrandController::class, 'brandCatSearch'])
            ->name('brandCatSearch');

        Route::post('ajax-pagination', [StaffBrandController::class, 'ajaxPagination'])
            ->name('ajaxPagination');

        Route::get('create', [StaffBrandController::class, 'create'])
            ->name('create');

        Route::post('store', [StaffBrandController::class, 'store'])
            ->name('store');

        Route::get('edit/{id}', [StaffBrandController::class, 'edit'])
            ->name('edit');

        Route::post('update', [StaffBrandController::class, 'update'])
            ->name('update');

        Route::post('delete', [StaffBrandController::class, 'moveToTrash'])
            ->name('moveToTrash');

        Route::get('trash', [StaffBrandController::class, 'trash'])
            ->name('trash');

        Route::post('trash-pagination', [StaffBrandController::class, 'trashPagination'])
            ->name('trashPagination');

        Route::post('force-delete', [StaffBrandController::class, 'removeFromTrash'])
            ->name('removeFromTrash');

        Route::post('restore', [StaffBrandController::class, 'restoreFromTrash'])
            ->name('restoreFromTrash');

        Route::post('ajaxupload', [StaffBrandController::class, 'uploadImage'])
            ->name('ajaxupload');

        Route::post('upload-update', [StaffBrandController::class, 'uploadUpdate'])
            ->name('uploadUpdate');

        Route::post('ajaxdelete', [StaffBrandController::class, 'deleteImage'])
            ->name('ajaxdelete');

    });

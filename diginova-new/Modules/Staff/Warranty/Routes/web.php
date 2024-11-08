<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Warranty\Http\Controllers\StaffWarrantyController;

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

Route::domain('staff.diginova.test')->prefix('warranties')->name('staff.warranties.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffWarrantyController::class, 'index'])
        ->name('index');

    Route::post('filter', [StaffWarrantyController::class, 'filterByType'])
        ->name('filterByType');

    Route::post('warranty-search', [StaffWarrantyController::class, 'warrantySearch'])
        ->name('warrantySearch');

    Route::post('warranty-cat-search', [StaffWarrantyController::class, 'warrantyCatSearch'])
        ->name('warrantyCatSearch');

    Route::post('ajax-pagination', [StaffWarrantyController::class, 'ajaxPagination'])
        ->name('ajaxPagination');

    Route::get('create', [StaffWarrantyController::class, 'create'])
        ->name('create');

    Route::post('store', [StaffWarrantyController::class, 'store'])
        ->name('store');

    Route::get('edit/{id}', [StaffWarrantyController::class, 'edit'])
        ->name('edit');

    Route::post('update', [StaffWarrantyController::class, 'update'])
        ->name('update');

    Route::post('delete', [StaffWarrantyController::class, 'moveToTrash'])
        ->name('moveToTrash');

    Route::get('trash', [StaffWarrantyController::class, 'trash'])
        ->name('trash');

    Route::post('trash-pagination', [StaffWarrantyController::class, 'trashPagination'])
        ->name('trashPagination');

    Route::post('force-delete', [StaffWarrantyController::class, 'removeFromTrash'])
        ->name('removeFromTrash');

    Route::post('restore', [StaffWarrantyController::class, 'restoreFromTrash'])
        ->name('restoreFromTrash');

    Route::post('ajaxupload', [StaffWarrantyController::class, 'uploadImage'])
        ->name('ajaxupload');

    Route::post('upload-update', [StaffWarrantyController::class, 'uploadUpdate'])
        ->name('uploadUpdate');

    Route::post('ajaxdelete', [StaffWarrantyController::class, 'deleteImage'])
        ->name('ajaxdelete');
});

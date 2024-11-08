<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Category\Http\Controllers\StaffCategoryController;

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

Route::domain('staff.diginova.test')->prefix('categories')->name('staff.categories.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffCategoryController::class, 'index'])
        ->name('index');

    Route::get('create', [StaffCategoryController::class, 'create'])
        ->name('create');

    Route::post('store', [StaffCategoryController::class, 'store'])
        ->name('store');

    Route::post('update', [StaffCategoryController::class, 'update'])
        ->name('update');

    Route::get('{id}/edit', [StaffCategoryController::class, 'edit'])
        ->name('edit');

    Route::post('get-data', [StaffCategoryController::class, 'getData'])
        ->name('getData');

    Route::post('ajax-search', [StaffCategoryController::class, 'ajaxSearch'])
        ->name('ajaxsearch');

    Route::post('search-categories', [StaffCategoryController::class, 'searchCategories'])
      ->name('searchCategories');

    Route::post('ajax-upload', [StaffCategoryController::class, 'uploadImage'])
        ->name('ajaxupload');

    Route::post('upload-update', [StaffCategoryController::class, 'uploadUpdate'])
        ->name('uploadUpdate');

    Route::post('ajaxdelete', [StaffCategoryController::class, 'deleteImage'])
        ->name('ajaxdelete');

    Route::post('child-categories-loader', [StaffCategoryController::class, 'childCatsLoader'])
        ->name('childCatsLoader');

    Route::post('breadcrumb-loader', [StaffCategoryController::class, 'breadcrumbLoader'])
        ->name('breadcrumbLoader');

    Route::post('main-cat-reloader', [StaffCategoryController::class, 'mainCatReloader'])
        ->name('mainCatLoader');

    Route::post('destroy', [StaffCategoryController::class, 'destroy'])
        ->name('destroy');

});

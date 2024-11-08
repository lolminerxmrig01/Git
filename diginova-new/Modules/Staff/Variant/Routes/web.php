<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Variant\Http\Controllers\StaffVariantController;
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

Route::domain('staff.diginova.test')->prefix('variants')->name('staff.variants.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffVariantController::class, 'index'])
        ->name('index');

    Route::get('config-category', [StaffVariantController::class, 'variantCategory'])
        ->name('variantCategory');

    Route::post('save-config', [StaffVariantController::class, 'saveConfig'])
        ->name('saveConfig');

    Route::post('load-category-variant', [StaffVariantController::class, 'loadCategoryVariant'])
        ->name('loadCategoryVariant');

    Route::post('index-change-position', [StaffVariantController::class, 'indexChangePosition'])
        ->name('indexChangePosition');

    Route::post('store-group', [StaffVariantController::class, 'storeGroup'])
        ->name('storeGroup');

    Route::post('store', [StaffVariantController::class, 'store'])
        ->name('store');

    Route::get('edit/{id}', [StaffVariantController::class, 'edit'])
        ->name('edit');

    Route::post('update', [StaffVariantController::class, 'update'])
        ->name('update');

    Route::post('delete-group', [StaffVariantController::class, 'deleteGroup'])
        ->name('deleteGroup');

    Route::post('status-group', [StaffVariantController::class, 'statusGroup'])
        ->name('statusGroup');

    Route::post('get-data', [StaffVariantController::class, 'getData'])
        ->name('getData');

    Route::post('child-categories-loader', [StaffVariantController::class, 'childCatsLoader'])
        ->name('childCatsLoader');

    Route::post('breadcrumb-loader', [StaffVariantController::class, 'breadcrumbLoader'])
        ->name('breadcrumbLoader');

    Route::post('main-cat-reloader', [StaffVariantController::class, 'mainCatReloader'])
        ->name('mainCatLoader');

    Route::post('ajax-search', [StaffVariantController::class, 'ajaxSearch'])
        ->name('ajaxsearch');

    Route::post('unit-selector', [StaffVariantController::class, 'unitSelector'])
        ->name('unitSelector');



});

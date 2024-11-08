<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Attribute\Http\Controllers\StaffAttributeController;
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

Route::domain('staff.diginova.test')->prefix('attributes')->name('staff.attributes.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffAttributeController::class, 'index'])
        ->name('index');

    Route::post('index-change-position', [StaffAttributeController::class, 'indexChangePosition'])
        ->name('indexChangePosition');

    Route::post('store-group', [StaffAttributeController::class, 'storeGroup'])
        ->name('storeGroup');

    Route::post('store', [StaffAttributeController::class, 'store'])
        ->name('store');

    Route::get('edit/{id}', [StaffAttributeController::class, 'edit'])
        ->name('edit');

    Route::post('update', [StaffAttributeController::class, 'update'])
        ->name('update');

    Route::post('delete-group', [StaffAttributeController::class, 'deleteGroup'])
        ->name('deleteGroup');

    Route::post('status-group', [StaffAttributeController::class, 'statusGroup'])
        ->name('statusGroup');

    Route::post('get-data', [StaffAttributeController::class, 'getData'])
        ->name('getData');

    Route::post('child-categories-loader', [StaffAttributeController::class, 'childCatsLoader'])
        ->name('childCatsLoader');

    Route::post('breadcrumb-loader', [StaffAttributeController::class, 'breadcrumbLoader'])
        ->name('breadcrumbLoader');

    Route::post('main-cat-reloader', [StaffAttributeController::class, 'mainCatReloader'])
        ->name('mainCatLoader');

    Route::post('ajax-search', [StaffAttributeController::class, 'ajaxSearch'])
        ->name('ajaxsearch');

    Route::post('unit-selector', [StaffAttributeController::class, 'unitSelector'])
        ->name('unitSelector');
});

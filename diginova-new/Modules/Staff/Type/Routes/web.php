<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Type\Http\Controllers\StaffTypeController;

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

Route::domain('staff.diginova.test')->prefix('types')->name('staff.types.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffTypeController::class, 'index'])
        ->name('index');

    Route::post('store', [StaffTypeController::class, 'store'])
        ->name('store');

    Route::post('update', [StaffTypeController::class, 'update'])
        ->name('update');

    Route::post('get-data', [StaffTypeController::class, 'getData'])
        ->name('getData');

    Route::post('child-categories-loader', [StaffTypeController::class, 'childCatsLoader'])
        ->name('childCatsLoader');

    Route::post('breadcrumb-loader', [StaffTypeController::class, 'breadcrumbLoader'])
        ->name('breadcrumbLoader');

    Route::post('main-cat-reloader', [StaffTypeController::class, 'mainCatReloader'])
        ->name('mainCatLoader');

    Route::post('ajax-search', [StaffTypeController::class, 'ajaxSearch'])
        ->name('ajaxsearch');
});

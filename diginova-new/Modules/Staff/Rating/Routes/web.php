<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Rating\Http\Controllers\StaffRatingController;

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

Route::domain('staff.diginova.test')->prefix('ratings')->name('staff.ratings.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffRatingController::class, 'index'])
        ->name('index');

    Route::post('store', [StaffRatingController::class, 'store'])
        ->name('store');

    Route::post('update', [StaffRatingController::class, 'update'])
        ->name('update');

    Route::post('get-data', [StaffRatingController::class, 'getData'])
        ->name('getData');

    Route::post('child-categories-loader', [StaffRatingController::class, 'childCatsLoader'])
        ->name('childCatsLoader');

    Route::post('breadcrumb-loader', [StaffRatingController::class, 'breadcrumbLoader'])
        ->name('breadcrumbLoader');

    Route::post('main-cat-reloader', [StaffRatingController::class, 'mainCatReloader'])
        ->name('mainCatLoader');

    Route::post('ajax-search', [StaffRatingController::class, 'ajaxSearch'])
        ->name('ajaxsearch');
});

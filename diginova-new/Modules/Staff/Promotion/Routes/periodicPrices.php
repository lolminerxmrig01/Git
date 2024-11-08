<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Promotion\Http\Controllers\StaffPeriodicPricesController;

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


Route::domain('staff.diginova.test')->prefix('periodic-prices')->name('staff.periodic-prices.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/active', [StaffPeriodicPricesController::class, 'active'])
        ->name('index');

    Route::post('/active/search', [StaffPeriodicPricesController::class, 'search'])
        ->name('search');

    Route::get('/active/search', [StaffPeriodicPricesController::class, 'search'])
        ->name('search');

    Route::post('moveToEnds', [StaffPeriodicPricesController::class, 'moveToEnds'])
        ->name('moveToEnds');

    Route::post('/ended/search', [StaffPeriodicPricesController::class, 'endedSearch'])
    ->name('endedSearch');

    Route::get('/ended/search', [StaffPeriodicPricesController::class, 'endedSearch'])
        ->name('endedSearch');

    Route::get('/ended', [StaffPeriodicPricesController::class, 'ended'])
        ->name('ended');

    Route::post('{id}/load-product-variants', [StaffPeriodicPricesController::class, 'loadProductVariants'])
        ->name('loadProductVariants');

    Route::get('{id}/load-product-variants', [StaffPeriodicPricesController::class, 'loadProductVariants'])
        ->name('loadProductVariants');

    Route::post('render-add-variants-rows', [StaffPeriodicPricesController::class, 'renderAddVariantsRows'])
        ->name('renderAddVariantsRows');

    Route::post('save', [StaffPeriodicPricesController::class, 'save'])
        ->name('save');

    Route::post('{id}/delete', [StaffPeriodicPricesController::class, 'delete'])
        ->name('delete');

    Route::get('done/index', [StaffPeriodicPricesController::class, 'done'])
        ->name('done');

});

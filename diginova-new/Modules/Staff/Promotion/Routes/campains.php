<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Promotion\Http\Controllers\StaffCampainController;
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



Route::domain('staff.diginova.test')->prefix('campains')->name('staff.campains.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffCampainController::class, 'index'])
        ->name('index');

    Route::post('moveToEnds', [StaffCampainController::class, 'moveToEnds'])
        ->name('moveToEnds');

    Route::get('create', [StaffCampainController::class, 'create'])
        ->name('create');

    Route::get('ended', [StaffCampainController::class, 'ended'])
        ->name('ended');

    Route::post('update/{id}', [StaffCampainController::class, 'update'])
        ->name('update');

    Route::get('{id}', [StaffCampainController::class, 'manage'])
        ->name('manage');

    Route::get('searchCampain', [StaffCampainController::class, 'searchCampain'])
        ->name('searchCampain');

    Route::post('searchCampain', [StaffCampainController::class, 'searchCampain'])
        ->name('searchCampain');

    Route::post('campainStatus', [StaffCampainController::class, 'campainStatus'])
        ->name('campainStatus');

    Route::post('removeCampain/{id}', [StaffCampainController::class, 'removeCampain'])
        ->name('removeCampain');

    Route::post('render-add-variants-rows', [StaffCampainController::class, 'renderAddVariantsRows'])
        ->name('renderAddVariantsRows');

    Route::get('ended/search', [StaffCampainController::class, 'endedCampainSearch'])
        ->name('endedCampainSearch');

    Route::post('ended/campainSearch', [StaffCampainController::class, 'endedCampainSearch'])
        ->name('endedCampainSearch');

    Route::post('search', [StaffCampainController::class, 'search'])
        ->name('search');

    Route::get('search', [StaffCampainController::class, 'search'])
        ->name('search');


        
    Route::post('{id}/load-product-variants', [StaffPeriodicPricesController::class, 'loadProductVariants'])
    ->name('loadProductVariants');

    Route::get('{id}/load-product-variants', [StaffPeriodicPricesController::class, 'loadProductVariants'])
        ->name('loadProductVariants');

});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Landing\Http\Controllers\StaffLandingController;

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


Route::domain('staff.diginova.test')->prefix('landings')->name('staff.landings.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffLandingController::class, 'index'])
        ->name('index');

    Route::get('create', [StaffLandingController::class, 'create'])
        ->name('create');

    Route::post('update/{id}', [StaffLandingController::class, 'update'])
        ->name('update');

    Route::get('{id}', [StaffLandingController::class, 'manage'])
        ->name('manage');

    Route::get('{id}/search', [StaffLandingController::class, 'search'])
        ->name('search');

    Route::post('addVariant/{id}', [StaffLandingController::class, 'addVariant'])
        ->name('addVariant');

    Route::get('variants/{id}', [StaffLandingController::class, 'variants'])
        ->name('variants');

    Route::post('removeVariant/{id}', [StaffLandingController::class, 'removeVariant'])
        ->name('removeVariant');

    Route::post('removeAll/{id}', [StaffLandingController::class, 'removeAll'])
        ->name('removeAll');

    Route::get('searchLanding', [StaffLandingController::class, 'searchLanding'])
        ->name('searchLanding');

    Route::post('searchLanding', [StaffLandingController::class, 'searchLanding'])
        ->name('searchLanding');

    Route::post('removeLanding/{id}', [StaffLandingController::class, 'removeLanding'])
        ->name('removeLanding');

    Route::post('statusGroup', [StaffLandingController::class, 'statusGroup'])
        ->name('statusGroup');

});

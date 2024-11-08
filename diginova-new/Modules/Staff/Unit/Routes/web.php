<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Unit\Http\Controllers\StaffUnitController;

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

Route::domain('staff.diginova.test')->prefix('units')->name('staff.units.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffUnitController::class, 'index'])
        ->name('index');

    Route::post('edit', [StaffUnitController::class, 'edit'])
      ->name('edit');

    Route::post('update', [StaffUnitController::class, 'update'])
      ->name('update');

    Route::post('store', [StaffUnitController::class, 'store'])
      ->name('store');

    Route::post('delete', [StaffUnitController::class, 'delete'])
      ->name('delete');

    Route::post('index-change-position', [StaffUnitController::class, 'indexChangePosition'])
        ->name('indexChangePosition');

});

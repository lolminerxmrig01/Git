<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Peyment\Http\Controllers\StaffPeymentMethodController;

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

Route::domain('staff.diginova.test')->name('staff.peyment.')->prefix('peyment-methods')
  ->middleware('web', 'staff')->group(function () {


    Route::get('/', [StaffPeymentMethodController::class, 'index'])
      ->name('index');

    Route::get('edit/{id}', [StaffPeymentMethodController::class, 'edit'])
      ->name('edit');

    Route::post('storePeymentMethod', [StaffPeymentMethodController::class, 'storePeymentMethod'])
      ->name('storePeymentMethod');

    Route::post('status', [StaffPeymentMethodController::class, 'status'])
      ->name('status');

  });

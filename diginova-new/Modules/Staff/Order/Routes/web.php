<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Order\Http\Controllers\StaffOrderController;

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

Route::domain('staff.diginova.test')->prefix('orders')->name('staff.orders.')
  ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffOrderController::class, 'index'])
      ->name('index');

    Route::get('{id}/details', [StaffOrderController::class, 'details'])
      ->name('details');

    Route::post('updateDetail', [StaffOrderController::class, 'updateDetail'])
      ->name('updateDetail');

    Route::get('{id}/invoice', [StaffOrderController::class, 'invoice'])
      ->name('invoice');

    Route::post("search", [StaffOrderController::class, 'search'])
      ->name('search');

});


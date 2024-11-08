<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Shiping\Http\Controllers\StaffDeliveryMethodController;

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

Route::domain('staff.diginova.test')->name('staff.delivery.')->prefix('delivery-method')
  ->middleware('web', 'staff')->group(function () {


    Route::get('/', [StaffDeliveryMethodController::class, 'index'])
      ->name('index');

    Route::get('edit/{id}', [StaffDeliveryMethodController::class, 'edit'])
      ->name('edit');

    Route::post('edit/{id}/contentLoader', [StaffDeliveryMethodController::class, 'contentLoader'])
      ->name('contentLoader');

    Route::post('storeDeliveryMethod', [StaffDeliveryMethodController::class, 'storeDeliveryMethod'])
      ->name('storeDeliveryMethod');

    Route::post('deleteIcon', [StaffDeliveryMethodController::class, 'deleteIcon'])
      ->name('deleteIcon');

    Route::post('upload-image', [StaffDeliveryMethodController::class, 'UploadImage'])
      ->name('UploadImage');

    Route::post('status', [StaffDeliveryMethodController::class, 'status'])
      ->name('status');

  });

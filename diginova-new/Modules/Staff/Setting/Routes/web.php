<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Setting\Http\Controllers\StaffSettingController;

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

Route::domain('staff.diginova.test')->prefix('settings')->name('staff.settings.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffSettingController::class, 'index'])
        ->name('index');

    Route::post('update', [StaffSettingController::class, 'update'])
        ->name('update');

    Route::post('UploadImage', [StaffSettingController::class, 'UploadImage'])
        ->name('UploadImage');

    Route::post('deleteStampImage', [StaffSettingController::class, 'deleteStampImage'])
        ->name('deleteStampImage');
});

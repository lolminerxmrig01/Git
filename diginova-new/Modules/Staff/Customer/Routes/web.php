<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Customer\Http\Controllers\StaffCustomerController;

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

Route::domain('staff.diginova.test')->prefix('customers')->name('staff.customers.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffCustomerController::class, 'index'])
        ->name('index');

    Route::get('{id}/profile', [StaffCustomerController::class, 'profile'])
      ->name('profile');

    Route::post('remove/{id}', [StaffCustomerController::class, 'remove'])
      ->name('remove');

    Route::post('update', [StaffCustomerController::class, 'update'])
        ->name('update');

    Route::post('cities', [StaffCustomerController::class, 'cities'])
        ->name('cities');

    Route::post('district', [StaffCustomerController::class, 'district'])
        ->name('district');

    Route::post('search', [StaffCustomerController::class, 'search'])
        ->name('search');

});

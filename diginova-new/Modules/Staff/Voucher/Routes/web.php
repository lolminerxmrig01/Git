<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Voucher\Http\Controllers\StaffVoucherController;

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

Route::domain('staff.diginova.test')->prefix('vouchers')->name('staff.vouchers.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffVoucherController::class, 'index'])
        ->name('index');

    Route::get('create', [StaffVoucherController::class, 'create'])
        ->name('create');

    Route::post('store', [StaffVoucherController::class, 'store'])
        ->name('store');

    Route::get('edit/{id}', [StaffVoucherController::class, 'edit'])
        ->name('edit');

    Route::post('update', [StaffVoucherController::class, 'update'])
        ->name('update');

    Route::post('delete', [StaffVoucherController::class, 'delete'])
        ->name('delete');

    Route::get('searchVoucher', [StaffVoucherController::class, 'searchVoucher'])
        ->name('searchVoucher');

    Route::post('searchVoucher', [StaffVoucherController::class, 'searchVoucher'])
        ->name('searchVoucher');

    Route::post('removeVoucher/{id}', [StaffVoucherController::class, 'removeVoucher'])
        ->name('removeVoucher');

    Route::post('statusVoucher', [StaffVoucherController::class, 'statusVoucher'])
        ->name('statusVoucher');

});

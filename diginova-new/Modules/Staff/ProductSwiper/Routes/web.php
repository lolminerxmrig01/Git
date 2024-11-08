<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\ProductSwiper\Http\Controllers\StaffProductSwiperController;
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

Route::domain('staff.diginova.test')->prefix('product-swipers')->name('staff.productSwipers.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffProductSwiperController::class, 'index'])
      ->name('index');

    Route::post('update', [StaffProductSwiperController::class, 'update'])
        ->name('update');

});

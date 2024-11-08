<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Slider\Http\Controllers\StaffSliderController;

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

Route::domain('staff.diginova.test')->prefix('slider-groups')->name('staff.sliders.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffSliderController::class, 'index'])
        ->name('index');

    Route::get('{id}/sliders', [StaffSliderController::class, 'sliders'])
      ->name('sliders');

    Route::get('slider/{id}', [StaffSliderController::class, 'slider'])
      ->name('slider');

    Route::get('slider/{id}', [StaffSliderController::class, 'sliderImages'])
      ->name('sliderImages');

    Route::post('custom-ajax-upload', [StaffSliderController::class, 'customUploadImage'])
      ->name('customUploadImage');

    Route::post('ajax-upload', [StaffSliderController::class, 'UploadImage'])
      ->name('UploadImage');

    Route::post('updateSlider', [StaffSliderController::class, 'updateSlider'])
      ->name('updateSlider');

    Route::post('updateSliderImagesRow', [StaffSliderController::class, 'updateSliderImagesRow'])
      ->name('updateSliderImagesRow');

});

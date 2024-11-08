<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Nav\Http\Controllers\StaffNavController;

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

Route::domain('staff.diginova.test')->name('staff.navs.')
  ->middleware('web', 'staff')->group(function () {

    Route::get('nav-locations', [StaffNavController::class, 'index'])
      ->name('index');

    Route::get('nav-location/{id}/navs', [StaffNavController::class, 'navs'])
      ->name('navs');

    Route::get('nav/{id}/items', [StaffNavController::class, 'navItems'])
      ->name('navItems');

    Route::post('upload-image', [StaffNavController::class, 'UploadImage'])
      ->name('UploadImage');

    Route::post('storeNav', [StaffNavController::class, 'storeNav'])
      ->name('storeNav');

    Route::post('statusNav', [StaffNavController::class, 'statusNav'])
      ->name('statusNav');

    Route::post('reloadNavsTable', [StaffNavController::class, 'reloadNavsTable'])
      ->name('reloadNavsTable');

    Route::post('navChangePosition', [StaffNavController::class, 'navChangePosition'])
      ->name('navChangePosition');

    Route::post('deleteNav', [StaffNavController::class, 'deleteNav'])
      ->name('deleteNav');

    Route::post('updateNav', [StaffNavController::class, 'updateNav'])
      ->name('updateNav');

    Route::post('storeItem', [StaffNavController::class, 'storeItem'])
      ->name('storeItem');

    Route::post('reloadMegamenuTable', [StaffNavController::class, 'reloadMegamenuTable'])
      ->name('reloadMegamenuTable');

    Route::post('storeMegaMenu', [StaffNavController::class, 'storeMegaMenu'])
      ->name('storeMegaMenu');

    Route::post('storeMenus', [StaffNavController::class, 'storeMenus'])
      ->name('storeMenus');

    Route::post('itemChangePosition', [StaffNavController::class, 'itemChangePosition'])
      ->name('itemChangePosition');

    Route::post('deleteItem', [StaffNavController::class, 'deleteItem'])
      ->name('deleteItem');

    Route::post('deleteIcon', [StaffNavController::class, 'deleteIcon'])
      ->name('deleteIcon');

    Route::get('item/{id}/menus', [StaffNavController::class, 'ItemMenus'])
      ->name('ItemMenus');

    Route::get('megamenu/{id}/items', [StaffNavController::class, 'megamenuItems'])
      ->name('megamenuItems');
  });

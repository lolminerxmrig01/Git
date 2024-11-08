<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Product\Http\Controllers\StaffProductController;

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

Route::domain('staff.diginova.test')->prefix('products')->name('staff.products.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffProductController::class, 'index'])
    ->name('index');

    Route::post('update', [StaffProductController::class, 'update'])
        ->name('update');

    Route::get('create', [StaffProductController::class, 'create'])
        ->name('create');

    Route::get('edit/{id}', [StaffProductController::class, 'edit'])
        ->name('edit');

    Route::post('status-product', [StaffProductController::class, 'statusProduct'])
        ->name('statusProduct');

    Route::post('child-categories-loader', [StaffProductController::class, 'childCatsLoader'])
        ->name('childCatsLoader');

    Route::post('search-categories', [StaffProductController::class, 'searchCategories'])
        ->name('searchCategories');

    Route::post('create/step/product', [StaffProductController::class, 'stepProduct'])
        ->name('stepProduct');

    Route::post('create/step/attributes', [StaffProductController::class, 'stepAttributes'])
        ->name('stepAttributes');

    Route::post('create/step/product/save', [StaffProductController::class, 'stepProductSave'])
      ->name('stepProductSave');

    Route::post('create/step/attributes/save', [StaffProductController::class, 'stepAttributesSave'])
      ->name('stepAttributesSave');

    Route::post('create/step/upload', [StaffProductController::class, 'stepUploadImages'])
      ->name('stepUploadImages');

    Route::post('create/product/save', [StaffProductController::class, 'store'])
      ->name('store');

    Route::post('delete', [StaffProductController::class, 'moveToTrash'])
      ->name('moveToTrash');

    Route::get('trash', [StaffProductController::class, 'trash'])
      ->name('trash');

    Route::post('trash-pagination', [StaffProductController::class, 'trashPagination'])
      ->name('trashPagination');

    Route::post('force-delete', [StaffProductController::class, 'removeFromTrash'])
      ->name('removeFromTrash');

    Route::post('restore', [StaffProductController::class, 'restoreFromTrash'])
      ->name('restoreFromTrash');

    Route::post('ajax-pagination', [StaffProductController::class, 'ajaxPagination'])
      ->name('ajaxPagination');

    Route::post('filter', [StaffProductController::class, 'filterByType'])
      ->name('filterByType');

    Route::post('product-search', [StaffProductController::class, 'productSearch'])
      ->name('productSearch');

    Route::post('product-cat-search', [StaffProductController::class, 'productCatSearch'])
        ->name('productCatSearch');

    Route::get('variant/{id}', [StaffProductController::class, 'variant'])
        ->name('variant');

    Route::post('variant/save', [StaffProductController::class, 'variantSave'])
        ->name('variantSave');

    Route::post('variant/update', [StaffProductController::class, 'variantUpdate'])
        ->name('variantUpdate');

    Route::post('variant/variants-list', [StaffProductController::class, 'ajaxVariantsList'])
        ->name('ajaxVariantsList');

    Route::post('variant/delete', [StaffProductController::class, 'variantDelete'])
        ->name('variantDelete');

  });

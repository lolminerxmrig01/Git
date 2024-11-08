<?php

use Illuminate\Support\Facades\Route;
use Modules\Staff\Comment\Http\Controllers\StaffCommentController;

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

Route::domain('staff.diginova.test')->prefix('comments')->name('staff.comments.')
    ->middleware('web', 'staff')->group(function () {

    Route::get('/', [StaffCommentController::class, 'index'])
        ->name('index');

    Route::get('create', [StaffCommentController::class, 'create'])
        ->name('create');

    Route::post('store', [StaffCommentController::class, 'store'])
        ->name('store');

    Route::get('edit/{id}', [StaffCommentController::class, 'edit'])
        ->name('edit');

    Route::post('update', [StaffCommentController::class, 'update'])
        ->name('update');

    Route::post('delete', [StaffCommentController::class, 'delete'])
        ->name('delete');

    Route::get('searchComment', [StaffCommentController::class, 'searchComment'])
        ->name('searchComment');

    Route::post('searchComment', [StaffCommentController::class, 'searchComment'])
        ->name('searchComment');
});

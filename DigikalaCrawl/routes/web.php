<?php

use App\Http\Controllers\DigikalaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DigikalaController::class, 'index'])->where('productId', 'dkp-\d*');
Route::post('/ShowProduct/', [DigikalaController::class, 'ShowProduct'])->where('productId', 'dkp-\d*');
Route::get('/pdf/{productId}', [DigikalaController::class,'PdfProduct'])->where('productId', 'dkp-\d*');

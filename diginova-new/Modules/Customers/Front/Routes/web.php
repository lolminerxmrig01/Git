<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\Front\Http\Controllers\FrontController;
use Modules\Staff\Setting\Models\Setting;

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




Route::middleware('web')->name('front.')->group(function(){
  $product_code_prefix = mb_strtolower(Setting::where('name', 'product_code_prefix')->first()->value);
  Route::get("product/$product_code_prefix-{product_code}", [FrontController::class, 'productPage'])->name('productPage');
});

// ajax routes
Route::middleware('web')->name('front.')->group(function(){
  Route::get('mainsearch', [FrontController::class, 'mainSearch'])->name('front.mainSearch');
});

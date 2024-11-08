<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\Auth\Http\Controllers\CustomerRegLoginController;

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


Route::prefix('users')->middleware('web')->group(function(){
    Route::get('login-register', [CustomerRegLoginController::class, 'regLoginPage'])
        ->name('customer.regLoginPage');

    Route::post('login-register', [CustomerRegLoginController::class, 'check'])
        ->name('customer.check');

    Route::get('login/confirm', [CustomerRegLoginController::class, 'confirmPage'])
        ->name('customer.confirmPage');

    Route::post('login/confirm', [CustomerRegLoginController::class, 'confirm'])
        ->name('customer.confirm');

    Route::post('login/confirm/sms', [CustomerRegLoginController::class, 'confirmSms'])
        ->name('customer.confirmSms');

    Route::get('password/forgot', [CustomerRegLoginController::class, 'forgotPage'])
        ->name('customer.forgotPage');

    Route::post('password/forgot', [CustomerRegLoginController::class, 'forgot'])
        ->name('customer.forgot');

    Route::get('welcome', [CustomerRegLoginController::class, 'welcome'])
        ->name('customer.welcomme');

    Route::get('logout', [CustomerRegLoginController::class, 'logout'])
        ->name('customer.logout');
});

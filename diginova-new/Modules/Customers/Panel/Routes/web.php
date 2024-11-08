<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\Panel\Http\Controllers\CustomerProfileController;
use Modules\Customers\Front\Http\Controllers\FrontController;

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


Route::prefix('profile')->middleware('web', 'customer')->name('customer.panel.')->group(function(){

    Route::get('/', [CustomerProfileController::class, 'index'])
        ->name('index');

    Route::get('personal-info', [CustomerProfileController::class, 'personalInfo'])
        ->name('personalInfo');

    Route::post('personal-info/update', [CustomerProfileController::class, 'personalInfoUpdate'])
      ->name('personalInfoUpdate');

    Route::post('personal-info/change-password', [CustomerProfileController::class, 'ChangePassword'])
      ->name('personalInfoChangePass');

    Route::post('personal-info/confirm-phone', [CustomerProfileController::class, 'confirmPhone'])
      ->name('confirmPhone');

    Route::post('personal-info/send-confirm-code', [CustomerProfileController::class, 'sendConfirmCode'])
      ->name('sendConfirmCode');

    Route::get('favorites', [CustomerProfileController::class, 'favorites'])
          ->name('favorites');

//    Route::get('orders', [CustomerProfileController::class, 'orders'])
//        ->name('orders');

    Route::post('convert-card-to-iban', [CustomerProfileController::class, 'cardToIban'])
      ->name('cardToIban');

    Route::get('wallet', [CustomerProfileController::class, 'wallet'])
      ->name('wallet');

    Route::get('state/cities/{id}', [CustomerProfileController::class, 'cityLoader'])
      ->name('cityLoader');

    Route::get('city/districts/{id}', [CustomerProfileController::class, 'districtLoader'])
      ->name('districtLoader');

    Route::get('user-history', [CustomerProfileController::class, 'userHistory'])
      ->name('userHistory');

    Route::get('notification', [CustomerProfileController::class, 'notification'])
      ->name('notification');

    Route::get('giftcards', [CustomerProfileController::class, 'giftcards'])
      ->name('giftcards');

    Route::get('addresses', [CustomerProfileController::class, 'addresses'])
      ->name('addresses');

    Route::get('comments', [CustomerProfileController::class, 'comments'])
      ->name('comments');

    Route::get('favorites', [CustomerProfileController::class, 'favorites'])
      ->name('favorites');

    Route::get('my-orders/{activeTab?}', [CustomerProfileController::class, 'myOrders'])
      ->name('myOrders');

    Route::get('order/{order_code}', [CustomerProfileController::class, 'orderDetails'])
      ->name('orderDetails');

    Route::get('orders/{order_code}/invoice', [CustomerProfileController::class, 'orderInvoice'])
      ->name('orderInvoice');

    Route::get('test/{id}', [CustomerProfileController::class, 'test']);

});


Route::prefix('profile/ajax')->middleware('web', 'customer')->name('customer.panel.')->group(function(){

  Route::get('state/cities/{id}', [FrontController::class, 'cityLoader'])
    ->name('cityLoader');

  Route::get('city/districts/{id}', [FrontController::class, 'districtLoader'])
    ->name('districtLoader');

  Route::post('addresses/add', [FrontController::class, 'saveAddressFromPanel'])->name('saveAddressFromPanel');


});

Route::post('ajax/addresses/remove/{id}', [FrontController::class, 'removeCustomerAddressFromPanel'])->middleware('web', 'customer')->name('removeCustomerAddressFromPanel');

Route::get('payment/checkout/order/{order_code}', [CustomerProfileController::class, 'orderCheckout'])
  ->name('orderCheckout');

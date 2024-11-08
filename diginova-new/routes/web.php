<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\Front\Http\Controllers\FrontController;
use Modules\Customers\Front\Http\Controllers\CategoryController;
use Modules\Staff\Category\Models\Category;
use Modules\Staff\Promotion\Models\Campain;
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

Route::get('/', [FrontController::class, 'index'])->name('front.indexPage');


if (\Schema::hasTable('settings') && Setting::where('name', 'product_code_prefix')->count()) {
  $product_code_prefix = strtolower(Setting::where('name', 'product_code_prefix')->first()->value);
} else {
  $product_code_prefix = 'dnp';
}

Route::get("product/$product_code_prefix-{product_code}", [FrontController::class, 'productPage'])->name('front.productPage');
Route::get("cart/add/{variant_code}/1/", [FrontController::class, 'addToCart'])->name('front.addToCart');
Route::get("product/comment/$product_code_prefix-{product_code}", [FrontController::class, 'createComment'])
    ->middleware('web', 'customer')
    ->name('front.createComment');
Route::get('search/category-{slug}', [FrontController::class, 'categoryPage'])->name('front.categoryPage');
Route::get('search', [FrontController::class, 'search'])->name('search');

Route::prefix('ajax')->name('front.ajax.')->group(function () {
  Route::get('search/category-{slug}', [CategoryController::class, 'searchFilter'])->name('categoryPage');
  Route::get('search', [CategoryController::class, 'searchQuery'])->name('searchPage');

  Route::get('product/comments/{product_id}', [FrontController::class, 'productComments'])->name('productComments');
  Route::get('product/comments/list/{product_id}/', [FrontController::class, 'productCommentList'])->name('productCommentList');
  Route::post('product/comments/add/{product_id}', [FrontController::class, 'createComments'])->name('createComments');
  Route::post('comment/remove/{id}', [FrontController::class, 'removeComment'])->name('removeComment');

  Route::get('product/comments/like/{product_id}', [FrontController::class, 'likeComment'])->name('likeComment');
  Route::get('product/comments/dislike/{product_id}', [FrontController::class, 'dislikeComment'])->name('dislikeComment');

  Route::post('favorites/product/add/{product_id}', [FrontController::class, 'addToFavorites'])->name('addToFavorites');
  Route::get('favorites/product/remove/{product_id}', [FrontController::class, 'removeFromFavorites'])->name('removeFromFavorites');

  Route::get('cart/move/save-for-later/{variant_code}', [FrontController::class, 'saveForLater'])->name('saveForLater');

  Route::post('save-for-later/variant/remove/{variant_id}', [FrontController::class, 'removeFromSaveForLaterAjax'])->name('removeFromSaveForLater');
  Route::get('save-for-later/variant/remove/{variant_id}', [FrontController::class, 'removeFromSaveForLater']);
  Route::get('save-for-later/move/cart/{variant_id}', [FrontController::class, 'moveToFirstCart'])->name('moveToFirstCart');
  Route::get('save-for-later/move/all/cart', [FrontController::class, 'moveAllToFirstCart'])->name('moveAllToFirstCart');

  Route::get('state/cities/{id}', [FrontController::class, 'cityLoader'])->name('cityLoader');
  Route::get('city/districts/{id}', [FrontController::class, 'districtLoader'])->name('districtLoader');

  Route::get('shipping/shared-addresses/default/{id}', [FrontController::class, 'changeSharedDeliveryAddress'])->name('changeSharedDeliveryAddress');
  Route::get('shipping/address/default/{id}', [FrontController::class, 'changeCustomerDeliveryAddress'])->name('changeCustomerDeliveryAddress');
  Route::post('shipping/address/remove/{id}', [FrontController::class, 'removeCustomerDeliveryAddress'])->name('removeCustomerDeliveryAddress');
  Route::post('shipping/addresses/add', [FrontController::class, 'saveAddressFromShipping'])->name('saveAddressFromShipping');

  Route::post('shipping-cost', [FrontController::class, 'shippingCost'])->name('shippingCost');

  Route::post('save-shipping-cookie', [FrontController::class, 'saveShippingToCookie'])->name('saveShippingToCookie');

  Route::post('voucher/set', [FrontController::class, 'paymentVoucher'])->name('paymentVoucher');

  Route::get('voucher/remove', [FrontController::class, 'removeVoucher'])->name('removeVoucher');

  Route::post('submit-order-voucher-check', [FrontController::class, 'submitOrderVoucherCheck'])->name('submitOrder');

  Route::get('browsing-history/product/remove/{product_code}', [FrontController::class, 'removeFromHistory'])->name('removeFromHistory');

});

Route::get('cart/remove/{variant_code}', [FrontController::class, 'removeFromCart'])->name('removeFromCart');

Route::name('front.')->middleware('web', 'customer')->group(function () {
  Route::get("cart", [FrontController::class, 'cart'])->name('cart');
  Route::get("cart/change/{variant_code}/{count}", [FrontController::class, 'cartChange'])->name('cartChange');
  Route::get('addresses/add', [FrontController::class, 'addAddress'])->name('addAddress');
  Route::post('addresses/add/save', [FrontController::class, 'saveAddress'])->name('saveAddress');
  Route::post('addresses/search-address-reverse', [FrontController::class, 'searchAddressReverse'])->name('searchAddressReverse');
  Route::post('addresses/search-address', [FrontController::class, 'searchAddress'])->name('searchAddress');
  Route::get('shipping', [FrontController::class, 'shipping'])->name('shipping');
  Route::get('payment', [FrontController::class, 'payment'])->name('payment');
  Route::post('payment', [FrontController::class, 'submitOrder'])->name('submitOrder');
  Route::get('order/status/{order_code}', [FrontController::class, 'orderStatus'])->name('orderStatus');
  Route::get('profile/my-orders/{order_code}', [FrontController::class, 'profileOrders'])->name('profileOrders');
  Route::get('payment-order', [FrontController::class, 'paymentOrder'])->name('paymentOrder');
  Route::get('repayment-order/{order_code}', [FrontController::class, 'repaymentOrder'])->name('repaymentOrder');
  Route::get('reselect/{order_code}', [FrontController::class, 'reselectGateway'])->name('reselectGateway');
  Route::post('reselect/payment', [FrontController::class, 'reselectPaymant'])->name('reselectPaymant');
});

Route::get('tracker/events', function (){});

Route::get('ajax/profile/wallet', function () {});

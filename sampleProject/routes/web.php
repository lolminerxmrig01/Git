<?php

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


Route:: group(['namespace' => 'User'], function () {

    //introduction
    Route::get('ref/{id}', 'RegisterController@ref');

    //login
    Route::get('login', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@login');

    //Two-Factor Authentication
    Route::get('sms2fa', 'LoginController@sms2faIndex')->name('sms2fa');
    Route::post('sms2fa', 'LoginController@sms2fa');
    Route::post('sms2fa/resend', 'LoginController@sms2faResend')->name('sms2faResend');
    Route::get('google2fa', 'LoginController@google2faIndex')->name('google2fa');
    Route::post('google2fa', 'LoginController@google2fa');


    //forget
    Route::get('ForgetPassword', 'LoginController@ForgetIndex')->name('ForgetPassword');
    Route::post('ForgetPassword', 'LoginController@Forget');
    Route::get('ForgetPassword/ConfirmPassword', 'LoginController@ConfirmPasswordIndex')->name('ConfirmPassword');
    Route::post('ForgetPassword/ConfirmPassword', 'LoginController@ConfirmPassword');
    Route::post('ForgetPassword/resend', 'LoginController@resendForget')->name('ReSendSmsForget');


    //Register
    Route::get('/register', 'RegisterController@index')->name('Register');
    Route::post('/register', 'RegisterController@RegisterMobile');
    Route::post('register/resend', 'RegisterController@reSendSms')->name('ResendSmsRegister');
    Route::get('register/profile', 'RegisterController@ProfileIndex')->name('RegisterProfile');
    Route::post('register/profile', 'RegisterController@Profile');


});



Route:: group(['namespace' => 'User', 'middleware' => ['auth','access','notification']], function () {

    //logout
        Route::post('logout', 'LoginController@logout');
        Route::post('remove-all-notifications', 'DashboardController@RemoveAllNotifications');
        Route::post('cities', 'ProfileController@get_cities')->withoutMiddleware(['auth','access','notification']);

    //firebase
        Route::post('token', 'DashboardController@insert_token');
        Route::get('send', 'DashboardController@send');

    //profile
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('profile/address-ownership', 'ProfileController@address_ownership');

        Route::post('profile/mobile-ownership', 'ProfileController@send_otp_finotech')->name('mobileOwnership');
        Route::post('profile/mobile-ownership/resend', 'ProfileController@resend_otp_finotech')->name('ResendFinotech');
        Route::post('profile/national-card', 'ProfileController@national_card');
        Route::post('profile/selfie', 'ProfileController@selfieImg');
        Route::view('profile/password','user.profile.password')->name('password');
        Route::post('profile/password', 'ProfileController@edit_password');
        Route::get('profile/two-factor-authentication', 'ProfileController@twofa')->name('two-factor-authentication');
        Route::post('profile/two-factor-authentication/sms', 'ProfileController@twofa_sms');
        Route::post('profile/two-factor-authentication/google', 'ProfileController@twofa_google');
        Route::get('profile/financial', 'ProfileController@financialIndex')->name('financial');
        Route::post('profile/financial', 'ProfileController@financial');
        Route::get('profile/wallet', 'ProfileController@walletIndex');
        Route::post('profile/wallet', 'ProfileController@wallet');
        Route::get('profile/log-activity', 'ProfileController@logActivity');

        //ticket
        Route::get('ticket', 'TicketController@index');
        Route::get('ticket/list', 'TicketController@list_ticket');
        Route::post('ticket', 'TicketController@insert');
        Route::get('ticket/{id}', 'TicketController@singleIndex');
        Route::post('ticket/{id}', 'TicketController@single');


    $Cryptocurrency = \App\Cryptocurrency::all();
    foreach ($Cryptocurrency as $Crypto){
        Route::post($Crypto->name.'/calculate', 'CryptoController@calculate');

        Route::get($Crypto->name, 'CryptoController@BuyIndex')->name($Crypto->name);
        Route::post($Crypto->name, 'CryptoController@buy');
        Route::get($Crypto->name.'/buy/{id}', 'CryptoController@buy_payment');
        Route::match(['get', 'post'],$Crypto->name.'/buy/{id}/callback', 'CryptoController@buy_payment_callback');
        Route::get($Crypto->name.'/sell', 'CryptoController@sellIndex')->name($Crypto->name.'Sell');
        Route::post($Crypto->name.'/sell', 'CryptoController@sell');
        Route::get($Crypto->name.'/sell/{id}', 'CryptoController@sell_callback');
    }

    Route::get('crypto/wallet', 'WalletController@check_stock2');
    Route::get('stock', 'DashboardController@index');

    //wallet
    Route::get('wallet', 'WalletController@index_increase');
    Route::post('wallet', 'WalletController@increase');
    Route::match(['get', 'post'],'wallet/callback/{id}', 'WalletController@increase_callback');
    Route::get('wallet/withdraw', 'WalletController@index_decrement');
    Route::post('wallet/withdraw', 'WalletController@decrement');
    Route::get('wallet/withdraw/{id}', 'WalletController@decrementCallback');
    Route::get('wallet/{id}', 'WalletController@single_finance');
    Route::get('wallet-fee', 'CryptoController@getFee');

    //invitation
    Route::get('invitation', 'InvitationController@index');
    Route::get('invitation/list', 'InvitationController@list_orders');

    //Orders
    Route::get('open-orders', 'OrdersController@open_orders');
    Route::get('orders/list', 'OrdersController@list_orders');
    Route::get('orders/{id}', 'OrdersController@single');

    //history
    Route::get('history/orders', 'OrdersController@index');
    Route::get('history/deposit', 'WalletController@list_deposit');
    Route::get('history/withdraw', 'WalletController@list_withdraw');

    //dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::post('/dashboard/redirect', 'DashboardController@redirectForm');
    Route::post('/stock', 'DashboardController@check_stock');
    Route::post('/max-sale', 'DashboardController@maxSale');
    Route::post('/RemoveNotification', 'DashboardController@RemoveNotification');

    Route::post('infoCurrency/{coin}', function (\Illuminate\Http\Request $request,$coin){
        $functions = new \App\functions;
        $result = $functions->infoCoin($coin,$request->type);
        return response()->json($result);
    });

//    Shop Product
    Route::get('/products', 'ProductController@index');
    Route::get('/product/{id}', 'ProductController@detail');
    Route::post('/add-to-cart/{id}', 'ShopController@addToCart');
    Route::get('/cart', 'ShopController@index');
    Route::get('/product-orders', 'ShopController@order');
    Route::get('/product-orders/{id}', 'ShopController@orderDetail');
    Route::post('/shopping', 'ShopController@shopping');
});

    Route::get('menu','MenuController@MenuAdmin');

    // Admin
    Route:: group(['prefix' => env('PanelPrefix') ,'namespace' => 'Admin'], function () {
    Route::get('','AdminAuth\LoginController@index')->name('A-login');
    Route::get('login','AdminAuth\LoginController@index');
    Route::post('login','AdminAuth\LoginController@login')->name('A-loginPost');
    Route::post('logout','AdminAuth\LoginController@logout')->name('A-logout');

    //Two-Factor Authentication
    Route::get('sms2fa', 'AdminAuth\LoginController@sms2faIndex')->name('A-sms2fa');
    Route::post('sms2fa', 'AdminAuth\LoginController@sms2fa');
    Route::post('sms2fa/resend', 'AdminAuth\LoginController@sms2faResend')->name('A-sms2faResend');
    Route::get('google2fa', 'AdminAuth\LoginController@google2faIndex')->name('A-google2fa');
    Route::post('google2fa', 'AdminAuth\LoginController@google2fa');

});

Route:: group(['prefix' => env('PanelPrefix') ,'namespace' => 'Admin', 'middleware' => ['auth:admin','notification','access']], function () {

    //dashboard
    Route::get('dashboard', 'DashboardController@index')->name('A-dashboard');
    Route::post('dashboard', 'SettingsController@save');
    Route::post('/stock', 'DashboardController@check_stock');

    //Profile
    Route::get('profile', 'ProfileController@index');
    Route::post('profile', 'ProfileController@profile');
    Route::get('profile/two-factor-authentication', 'ProfileController@twofa');
    Route::post('profile/two-factor-authentication/sms', 'ProfileController@twofa_sms');
    Route::post('profile/two-factor-authentication/google', 'ProfileController@twofa_google');

    //users
    Route::get('users', 'UsersController@index');
    Route::get('users/list', 'UsersController@list_users');

    //panel user
    Route::get('users/{id}', 'UsersController@single');
    Route::post('users/{id}/delete', 'UsersController@user_delete');
    Route::post('users/{id}/daily_buy', 'UsersController@change_daily_buy');
    Route::post('users/{id}/block', 'UsersController@block');
    Route::post('users/{id}/edit', 'UsersController@edit');
    Route::post('users/{id}/cardbank', 'UsersController@cardbank');
    Route::post('users/{id}/cardbank/remove', 'UsersController@cardbank_delete');
    Route::post('users/{id}/cardbank/add', 'UsersController@cardbank_add');
    Route::get('users/{id}/cardbank/{id_card}', 'UsersController@cardbank_info_modal');
    Route::post('users/{id}/cardbank/{id_card}/edit', 'UsersController@cardbank_edit');
    Route::post('users/{id}/cardbank/finnotech', 'UsersController@finnotech_card');
    Route::post('users/{id}/wallet', 'UsersController@wallet');
    Route::post('users/{id}/wallet/remove', 'UsersController@wallet_delete');
    Route::post('users/{id}/wallet/add', 'UsersController@wallet_add');
    Route::get('users/{id}/wallet/{id_wallet}', 'UsersController@wallet_info_modal');
    Route::post('users/{id}/wallet/{id_wallet}/edit', 'UsersController@wallet_edit');
    Route::get('users/{id}/orders', 'UsersController@list_orders');
    Route::get('users/{id}/finance', 'UsersController@list_finance');
    Route::post('users/{id}/finance/add', 'UsersController@add_finance');
    Route::get('users/{id}/invitation', 'UsersController@list_invitation');
    Route::post('users/{id}/notification', 'UsersController@notification');
    Route::post('users/{id}/images', 'UsersController@imagesConfirm');

    //Settings
    Route::get('general-settings', 'SettingsController@GeneralSettings');
    Route::get('payment-settings', 'SettingsController@PaymentSettings');
    Route::get('crypto-settings', 'SettingsController@CryptoSettings');
    Route::post('general-settings', 'SettingsController@save');
    Route::post('payment-settings', 'SettingsController@save');
    Route::post('crypto-settings', 'SettingsController@save');
    Route::delete('crypto-settings', 'SettingsController@Crypto_destroy');


    //CardBank
    Route::get('cardbank', 'CardBankController@index');
    Route::get('cardbank/list', 'CardBankController@list_cardbank');

    //Orders
    Route::get('orders', 'OrdersController@index');
    Route::post('orders/remove-all-moalagh', 'OrdersController@RemoveAllMoalagh');
    Route::get('orders/hesab', 'OrdersController@hesab_format');
    Route::get('orders/shaba', 'OrdersController@shba_format');
    Route::get('orders/list', 'OrdersController@list_orders');
    Route::get('orders/{id}', 'OrdersController@single');
    Route::delete('orders/{id}/remove', 'OrdersController@remove');
    Route::put('orders/{id}/status', 'OrdersController@status');
    Route::post('orders/{id}/ticket', 'OrdersController@insert_ticket');
    Route::post('orders/{id}/return-amount', 'OrdersController@return_amount');

    //ticket
    Route::get('ticket', 'TicketController@index');
    Route::get('ticket/list', 'TicketController@list_ticket');
    Route::post('ticket', 'TicketController@insert');
    Route::get('ticket/mobile', 'TicketController@mobile_search');
    Route::get('ticket/{id}', 'TicketController@singleIndex');
    Route::post('ticket/{id}', 'TicketController@single');
    Route::put('ticket/{id}/status', 'TicketController@status');
    Route::delete('ticket/{id}/remove', 'TicketController@remove');

    //Actions
    Route::get('actions', 'ActionsController@index_users');
    Route::get('actions/finance', 'ActionsController@index_finance');
    Route::get('actions/finance/all-confirm', 'ActionsController@all_confirm_finance');
    Route::post('actions/finance/all-confirm', 'ActionsController@confirm_finance');
    Route::get('actions/finance/{id}', 'ActionsController@single_finance');
    Route::put('actions/finance/{id}/payment', 'ActionsController@payment_finance');
    Route::get('actions/orders', 'ActionsController@index_orders');
    Route::get('actions/orders/list', 'ActionsController@list_orders');
    Route::get('actions/orders/all-confirm', 'ActionsController@all_confirm_orders');
    Route::post('actions/orders/all-confirm', 'ActionsController@confirm_orders');
    Route::get('actions/cardbank', 'ActionsController@index_cardbank');
    Route::get('actions/cardbank/list', 'ActionsController@list_cardbank');
    Route::get('actions/wallet', 'ActionsController@index_wallet');
    Route::get('actions/wallet/list', 'ActionsController@list_wallet');

    //Notification
    Route::get('notification', 'NotificationController@index');
    Route::get('notification/list', 'NotificationController@list_notification');
    Route::post('notification', 'NotificationController@notification');
    Route::delete('notification', 'NotificationController@delete');

    //invitation
    Route::get('invitation', 'InvitationController@index');
    Route::get('invitation/user-list', 'InvitationController@list_users');
    Route::get('invitation/finance-list', 'InvitationController@list_finance');

    //invitation
    Route::get('finances', 'FinanceController@index');
    Route::get('finances/list', 'FinanceController@list_finance');
    Route::get('finances/hesab', 'FinanceController@hesab_format');
    Route::get('finances/shaba', 'FinanceController@shaba_format');
    Route::get('finances/{id}', 'FinanceController@single_finance');
    Route::put('finances/{id}/confirm', 'FinanceController@confirm_finance');
    Route::put('finances/{id}/reject', 'FinanceController@reject_finance');
    Route::post('finances/{id}/return-amount', 'FinanceController@return_amount');
    Route::delete('finances/{id}/remove', 'FinanceController@remove');


    //reports
    Route::get('reports', 'ReportsController@index');
    Route::get('reports/load', 'ReportsController@load');
    Route::get('reports/users', 'ReportsController@user_index');
    Route::get('reports/users/list', 'ReportsController@list_user');

    //Admins
    Route::get('admins/', 'AdminsController@index');
    Route::post('admins/', 'AdminsController@insert');
    Route::get('admins/list', 'AdminsController@list_admins');
    Route::get('admins/{id}', 'AdminsController@single');
    Route::post('admins/{id}/edit', 'AdminsController@edit');
    Route::post('admins/{id}/block', 'AdminsController@block');
    Route::post('admins/{id}/remove', 'AdminsController@user_delete');
    Route::get('admins/{id}/log-list', 'AdminsController@LogList');

    //Shop
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@single');
    Route::post('categories', 'CategoryController@create');
    Route::delete('categories', 'CategoryController@destroy');
    Route::get('products', 'ProductController@index');
    Route::get('product-index', 'ProductController@ProductIndex');
    Route::POST('add-product', 'ProductController@addProduct');
    Route::delete('product/{id}/delete', 'ProductController@delete');
    Route::get('/shop-orders', 'ShopOrderController@index');
    Route::get('/shop-orders/{id}', 'ShopOrderController@single');
    Route::post('/shop-orders/note', 'ShopOrderController@adminNote');
    Route::get('user-add', 'UserAddController@index');
    Route::post('user-add/info-cardbank', 'UserAddController@infoCardbank');
    Route::post('user-add/info-mobile', 'UserAddController@infoMobile');
    Route::post('user-add', 'UserAddController@add');
    Route::get('shop', 'ShopController@index');
});

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

Route::get('/', 'PagesController@index')->name('pages.index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/email_verification/send', 'EmailVerificationController@send')->name('email_verification.send');
    Route::get('/email_verify_notice', 'PagesController@emailVerifyNotice')->name('email_verify_notice');
    Route::get('/email_verification/verify', 'EmailVerificationController@verify')->name('email_verification.verify');

    Route::group(['middleware' => 'email_verified'], function () {

        /*用户地址*/
        Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
        Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
        Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
        Route::get('user_addresses/{user_address}', 'UserAddressesController@edit')->name('user_addresses.edit');
        Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
        Route::delete('user_addresses/{user_address}', 'UserAddressesController@destory')->name('user_addresses.destory');

        /*商品*/
        Route::get('products', 'ProductsController@index')->name('products.index');
        Route::get('products/{product}', 'ProductsController@show')->name('products.show');

        /*购物车*/
        Route::get('cart','CartController@index')->name('cart.index');
        Route::post('cart', 'CartController@store')->name('cart.store');
        Route::delete('cart/{sku}', 'CartController@destory')->name('cart.destory');

        /*订单*/
        Route::get('orders', 'OrdersController@index')->name('orders.index');
        Route::get('orders/{order}/detail', 'OrdersController@detail')->name('orders.detail');
        Route::post('orders', 'OrdersController@store')->name('orders.store');
        Route::get('orders/{order}/show', 'OrdersController@show')->name('orders.show');

        /*支付*/
        Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
    });
});
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::namespace('Api')->group(function () {
    //店铺列表
    Route::get('shop/list','ShopController@list');
    Route::get('shop/index','ShopController@index');
    //会员管理
    Route::post('member/reg','MemberController@reg');
    Route::get('member/sms','MemberController@sms');
    Route::any('member/login','MemberController@login');
    Route::post('member/change','MemberController@change');
    Route::post('member/forget','MemberController@forget');
    Route::get('member/detail','MemberController@detail');
    //地址管理
    Route::get('address/index','AddressController@index');
    Route::post('address/add','AddressController@add');
    Route::get('address/edit','AddressController@edit');
    Route::post('address/update','AddressController@update');
    //购物车
    Route::get('cart/index','CartController@index');
    Route::post('cart/add','CartController@add');
    //订单管理
    Route::get('order/list','OrderController@list');
    Route::get('order/detail','OrderController@detail');
    Route::post('order/add','OrderController@add');
    //支付
    Route::post('order/pay','OrderController@pay');
});

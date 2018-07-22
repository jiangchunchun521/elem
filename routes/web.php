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

Route::get('/', function () {
    return view('welcome');
});
//平台admin
Route::domain('admin.elem.com')->namespace('Admin')->group(function () {
    //管理员
    Route::get('admin/index',"AdminController@index")->name('admin.index');
    Route::any('admin/reg',"AdminController@reg")->name('admin.reg');
    Route::any('admin/login',"AdminController@login")->name('admin.login');
    Route::get('admin/logout',"AdminController@logout")->name('admin.logout');
    Route::any('admin/modify',"AdminController@modify")->name('admin.modify');
    Route::any('admin/edit/{id}',"AdminController@edit")->name('admin.edit');
    Route::get('admin/del/{id}',"AdminController@del")->name('admin.del');
    //店铺分类
    Route::get('shop_category/index',"ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add',"ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}',"ShopCategoryController@edit")->name('shop_category.edit');
    Route::get('shop_category/del/{id}',"ShopCategoryController@del")->name('shop_category.del');
    //商家账号
    Route::get('user/index',"UserController@index")->name('users.index');
    Route::any('user/edit/{id}',"UserController@edit")->name('users.edit');
    Route::get('user/del/{id}',"UserController@del")->name('users.del');
    //商家信息
    Route::get('shop/index',"ShopController@index")->name('shop.index');
    Route::any('shop/add',"ShopController@add")->name('shop.add');
    Route::any('shop/check/{id}',"ShopController@check")->name('shop.check');
    Route::any('shop/edit/{id}',"ShopController@edit")->name('shop.edit');
    Route::get('shop/del/{id}',"ShopController@del")->name('shop.del');
});
//商户shop
Route::domain('shop.elem.com')->namespace('Shop')->group(function () {
    //商家账号
    Route::get('user/index',"UserController@index")->name('user.index');
    Route::any('user/reg',"UserController@reg")->name('user.reg');
    Route::any('user/login',"UserController@login")->name('user.login');
    Route::get('user/logout',"UserController@logout")->name('user.logout');
    Route::any('user/modify',"UserController@modify")->name('user.modify');
    //Route::any('user/edit/{id}',"UserController@edit")->name('user.edit');
    //Route::get('user/del/{id}',"UserController@del")->name('user.del');
});
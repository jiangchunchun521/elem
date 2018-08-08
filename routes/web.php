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
    Route::get('admin/index', "AdminController@index")->name('admin.index');
    Route::any('admin/reg', "AdminController@reg")->name('admin.reg');
    Route::any('admin/login', "AdminController@login")->name('admin.login');
    Route::get('admin/logout', "AdminController@logout")->name('admin.logout');
    Route::any('admin/modify', "AdminController@modify")->name('admin.modify');
    Route::any('admin/edit/{id}', "AdminController@edit")->name('admin.edit');
    Route::get('admin/del/{id}', "AdminController@del")->name('admin.del');
    //店铺分类
    Route::get('shop_category/index', "ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add', "ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}', "ShopCategoryController@edit")->name('shop_category.edit');
    Route::get('shop_category/del/{id}', "ShopCategoryController@del")->name('shop_category.del');
    //商家账号
    Route::get('user/index', "UserController@index")->name('users.index');
    Route::any('user/edit/{id}', "UserController@edit")->name('users.edit');
    Route::get('user/del/{id}', "UserController@del")->name('users.del');
    //商家信息
    Route::get('shop/index', "ShopController@index")->name('shop.index');
    Route::any('shop/add', "ShopController@add")->name('shop.add');
    Route::any('shop/check/{id}', "ShopController@check")->name('shop.check');
    Route::any('shop/edit/{id}', "ShopController@edit")->name('shop.edit');
    Route::get('shop/del/{id}', "ShopController@del")->name('shop.del');
    //活动
    Route::get('activity/index', "ActivityController@index")->name('activities.index');
    Route::get('activity/unStart', "ActivityController@unStart")->name('activities.unStart');
    Route::get('activity/going', "ActivityController@going")->name('activities.going');
    Route::get('activity/over', "ActivityController@over")->name('activities.over');
    Route::any('activity/add', "ActivityController@add")->name('activities.add');
    Route::any('activity/edit/{id}', "ActivityController@edit")->name('activities.edit');
    Route::get('activity/del/{id}', "ActivityController@del")->name('activities.del');
    //订单统计
    Route::get('order/index', "OrderController@index")->name('orders.index');
    Route::get('order/day', "OrderController@day")->name('orders.day');
    Route::get('order/month', "OrderController@month")->name('orders.month');
    Route::get('order/menu', "OrderController@menu")->name('orders.menu');
    Route::get('order/menuDay', "OrderController@menuDay")->name('orders.menuDay');
    Route::get('order/menuMonth', "OrderController@menuMonth")->name('orders.menuMonth');
    //会员
    Route::get('member/index', "MemberController@index")->name('member.index');
    Route::any('member/show/{id}', "MemberController@show")->name('member.show');
    Route::any('member/money/{id}', "MemberController@money")->name('member.money');
    //权限管理
    Route::get('per/index', "PermissionController@index")->name('per.index');
    Route::any('per/add', "PermissionController@add")->name('per.add');
    Route::get('per/del/{id}', "PermissionController@del")->name('per.del');
    //角色管理
    Route::get('role/index', "RoleController@index")->name('role.index');
    Route::any('role/add', "RoleController@add")->name('role.add');
    Route::any('role/edit/{id}', "RoleController@edit")->name('role.edit');
    Route::get('role/del/{id}', "RoleController@del")->name('role.del');
    //导航菜单
    Route::get('nav/index', "NavController@index")->name('nav.index');
    Route::any('nav/add', "NavController@add")->name('nav.add');
    //抽奖活动
    Route::get('event/index', "EventController@index")->name('events.index');
    Route::any('event/add', "EventController@add")->name('events.add');
    Route::any('event/edit/{id}', "EventController@edit")->name('events.edit');
    Route::get('event/del/{id}', "EventController@del")->name('events.del');
    Route::get('event/start/{id}', "EventController@start")->name('events.start');
    //活动奖品
    Route::get('prize/index', "EventPrizeController@index")->name('prizes.index');
    Route::any('prize/add', "EventPrizeController@add")->name('prizes.add');
    Route::any('prize/edit/{id}', "EventPrizeController@edit")->name('prizes.edit');
    Route::get('prize/del/{id}', "EventPrizeController@del")->name('prizes.del');
    //抽奖活动报名
    Route::get('eventUser/index', "EventUserController@index")->name('eventUsers.index');
});
//商户shop
Route::domain('shop.elem.com')->namespace('Shop')->group(function () {
    //商家账号
    Route::get('user/index', "UserController@index")->name('user.index');
    Route::any('user/reg', "UserController@reg")->name('user.reg');
    Route::any('user/login', "UserController@login")->name('user.login');
    Route::get('user/logout', "UserController@logout")->name('user.logout');
    Route::any('user/modify', "UserController@modify")->name('user.modify');
    //菜品分类
    Route::get('menu_category/index', "MenuCategoryController@index")->name('menu_category.index');
    Route::any('menu_category/add', "MenuCategoryController@add")->name('menu_category.add');
    Route::any('menu_category/edit/{id}', "MenuCategoryController@edit")->name('menu_category.edit');
    Route::get('menu_category/del/{id}', "MenuCategoryController@del")->name('menu_category.del');
    //菜品
    Route::get('menu/index', "MenuController@index")->name('menu.index');
    Route::any('menu/add', "MenuController@add")->name('menu.add');
    Route::any('menu/edit/{id}', "MenuController@edit")->name('menu.edit');
    Route::get('menu/del/{id}', "MenuController@del")->name('menu.del');
    //活动
    Route::get('activity/index', "ActivityController@index")->name('activity.index');
    Route::any('activity/show/{id}', "ActivityController@show")->name('activity.show');
    //订单
    Route::get('order/index', "OrderController@index")->name('order.index');
    Route::any('order/show/{id}', "OrderController@show")->name('order.show');
    Route::any('order/send/{id}', "OrderController@send")->name('order.send');
    Route::any('order/cancel/{id}', "OrderController@cancel")->name('order.cancel');
    Route::get('order/all', "OrderController@all")->name('order.all');
    Route::get('order/day', "OrderController@day")->name('order.day');
    Route::get('order/month', "OrderController@month")->name('order.month');
    Route::get('order/menu', "OrderController@menu")->name('order.menu');
    Route::get('order/menuDay', "OrderController@menuDay")->name('order.menuDay');
    Route::get('order/menuMonth', "OrderController@menuMonth")->name('order.menuMonth');
    //抽奖活动
    Route::get('event/index', "EventController@index")->name('event.index');
    Route::any('event/show/{id}', "EventController@show")->name('event.show');
    //抽奖活动结果(奖品)
    Route::get('prize/index', "EventPrizeController@index")->name('prize.index');
    Route::any('prize/show/{id}', "EventPrizeController@show")->name('prize.show');
    //抽奖活动报名
    Route::get('eventUser/index', "EventUserController@index")->name('eventUser.index');
    Route::any('eventUser/add', "EventUserController@add")->name('eventUser.add');
});
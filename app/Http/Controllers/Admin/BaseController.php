<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{
    public function __construct()
    {
        //添加一个中间键 登录验证
        $this->middleware('auth:admin')->except('login', 'reg');
        //再添加一个中间键 login只有guest才能访问
        $this->middleware("guest:admin")->only('login');
        //在这里判断用户有没有权限
        $this->middleware(function ($request, Closure $next) {
            $admin = Auth::guard('admin')->user();
            //判断当前路由在不在这个数组里，不在的话才验证权限，在的话不验证，还可以根据排除用户ID为1
            if (!in_array(Route::currentRouteName(), ['admin.login', 'admin.reg', 'admin.logout']) && $admin->id !== 1) {
                //判断当前用户有没有权限访问 路由名称就是权限名称
                if ($admin->can(Route::currentRouteName()) === false) {
                    //显示视图 不能用return 只能exit
                    exit(view('admin.fuck'));
                }
            }
            return $next($request);
        });
    }
}

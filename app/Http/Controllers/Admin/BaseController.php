<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        //添加一个中间键 登录验证
        $this->middleware('auth:admin')->except('login','reg');
        //再添加一个中间键 login只有guest才能访问
        $this->middleware("guest:admin")->only('login');
    }
}

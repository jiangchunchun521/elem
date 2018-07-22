<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        //添加一个中间键 登录验证
        $this->middleware('auth')->except('login','reg');
        //再添加一个中间键 login只有guest才能访问
        $this->middleware("guest")->only('login');
    }
}

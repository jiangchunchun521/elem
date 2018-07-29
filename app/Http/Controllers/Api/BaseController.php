<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 开启跨域
     * BaseController constructor.
     */
    public function __construct()
    {
        header('Access-Control-Allow-Origin:*');
    }
}

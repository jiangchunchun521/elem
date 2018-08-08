<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventUserController extends BaseController
{
    /**
     * 活动报名列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = EventUser::paginate(5);
        //显示视图并传递数据
        return view('admin.eventUser.index', compact('events'));
    }
}

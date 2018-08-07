<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends BaseController
{
    /**
     * 抽奖活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::paginate(3);
        //显示视图并传递数据
        return view('shop.event.index', compact('events'));
    }

    /**
     * 查看活动详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //通过id找到对象
        $event = Event::find($id);
        //显示视图并传递数据
        return view('shop.event.show', compact('event'));
    }
}

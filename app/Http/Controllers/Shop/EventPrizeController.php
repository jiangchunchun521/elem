<?php

namespace App\Http\Controllers\Shop;

use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{
    /**
     * 抽奖活动结果列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $prizes = EventPrize::paginate(3);
        //显示视图并传递数据
        return view('shop.prize.index', compact('prizes'));
    }

    /**
     * 查看奖品详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //通过id找到对象
        $prize = EventPrize::find($id);
        //显示视图并传递数据
        return view('shop.prize.show', compact('prize'));
    }
}

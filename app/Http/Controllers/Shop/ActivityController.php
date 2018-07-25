<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    /**
     * 活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //得到当前时间
        $time=date("Y-m-d",time());
        $activitys = Activity::whereDate('end_time','>',$time)->paginate(3);
        //显示视图并传递数据
        return view("shop.activity.index", compact("activitys"));
    }

    /**
     * 查看活动详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        //通过id找到对象
        $activity=Activity::find($id);
        //显示视图并传递数据
        return view("shop.activity.show", compact("activity"));
    }
}

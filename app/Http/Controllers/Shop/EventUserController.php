<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventUserController extends BaseController
{
    /**
     * 报名活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = EventUser::paginate(6);
        //显示视图并传递数据
        return view('shop.eventUser.index', compact('events'));
    }

    /**
     * 报名活动
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //得到所有抽奖活动
        $events = Event::all();
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'event_id' => 'required'
            ]);
            $data = $request->all();
            //报名商户
            $data['user_id'] = Auth::user()->id;
            //插入数据
            $eUser = EventUser::create($data);
            $event = Event::where('id', $eUser->event_id)->first();
            $event->num = $event->num + 1;
            $event->save();
            //提示
            $request->session()->flash('success', '报名成功');
            //跳转
            return redirect()->route('eventUser.index');
        }
        //显示视图并传递数据
        return view('shop.eventUser.add', compact('events'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{
    /**
     * 活动奖品列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $prizes = EventPrize::paginate(3);
        $userId = $prizes->pluck('user_id')->toArray();
        $user = User::whereIn('id', $userId)->first();
        //显示视图并传递数据
        return view('admin.prize.index', compact('prizes', 'user'));
    }

    /**
     * 添加活动奖品
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
                'name' => 'required',
                'event_id' => 'required'
            ]);
            //插入数据
            EventPrize::create($request->post());
            //提示
            $request->session()->flash('success', '活动奖品添加成功');
            //跳转
            return redirect()->route('prizes.index');
        }
        //显示视图并传递数据
        return view('admin.prize.add', compact('events'));
    }

    /**
     * 编辑活动奖品
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $prize = EventPrize::find($id);
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'name' => 'required'
            ]);
            //更新数据
            $prize->update($request->post());
            //提示
            $request->session()->flash('success', '活动奖品编辑成功');
            //跳转
            return redirect()->route('prizes.index');
        }
        //显示视图并传递数据
        return view('admin.prize.edit', compact('prize'));
    }

    /**
     * 删除活动奖品
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $prize = EventPrize::findOrFail($id);
        //删除数据
        $prize->delete();
        //提示
        $request->session()->flash('success', '活动奖品删除成功');
        //跳转
        return redirect()->route('prizes.index');
    }
}

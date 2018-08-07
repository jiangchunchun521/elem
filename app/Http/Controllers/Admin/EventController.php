<?php

namespace App\Http\Controllers\Admin;

use App\Mail\PrizeShipped;
use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EventController extends BaseController
{
    /**
     * 抽奖活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::paginate(3);
        //得到所有开奖时间
        $prizeDates = $events->pluck('prize_date')->toArray();
        foreach ($prizeDates as $prizeDate) {
            $event = Event::where('prize_date', $prizeDate)->first();
            //当开奖时间<=当前时间时，状态为已开奖
            if (date('Y-m-d h:i:s', $prizeDate) <= date('Y-m-d h:i:s', time())) {
                $event->is_prize = 1;
                $event->save();
            }
        }
        //显示视图并传递数据
        return view('admin.event.index', compact('events'));
    }

    /**
     * 添加抽奖活动
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required'
            ]);
            $data = $request->post();
            $data['is_prize'] = 0;
            $data['start'] = strtotime($data['start']);
            $data['end'] = strtotime($data['end']);
            $data['prize_date'] = strtotime($data['prize_date']);
            //插入数据
            Event::create($data);
            //提示
            $request->session()->flash('success', '抽奖活动添加成功');
            //跳转
            return redirect()->route('events.index');
        }
        //显示视图
        return view('admin.event.add');
    }

    /**
     * 编辑抽奖活动
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $event = Event::find($id);
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required'
            ]);
            $data = $request->post();
            $data['start'] = strtotime($data['start']);
            $data['end'] = strtotime($data['end']);
            $data['prize_date'] = strtotime($data['prize_date']);
            //插入数据
            $event->update($data);
            //提示
            $request->session()->flash('success', '抽奖活动编辑成功');
            //跳转
            return redirect()->route('events.index');
        }
        //显示视图并传递数据
        return view('admin.event.edit', compact('event'));
    }

    /**
     * 删除抽奖活动
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $event = Event::findOrFail($id);
        //删除数据
        $event->delete();
        //提示
        $request->session()->flash('success', '抽奖活动删除成功');
        //跳转
        return redirect()->route('events.index');
    }

    public function start(Request $request, $id)
    {
        /*//通过id找到对象
        $event = Event::find($id);*/
        //得到所有报名的商户
        $userId = EventUser::where('event_id', $id)->pluck('user_id')->toArray();
        //打乱数组
        shuffle($userId);
        //随机取出中奖商户
        $user=array_shift($userId);
        //取出该活动的奖品
        $prize=EventPrize::where('event_id',$id)->first();
        $prize->user_id=$user;
        if ($prize->save()) {
            $user = User::where('shop_id', $prize->user_id)->first();
            //通过审核发送邮件
            Mail::to($user)->send(new PrizeShipped($prize));
            //提示
            $request->session()->flash('success', '抽奖完成');
            //跳转
            return redirect()->route('events.index');
        }
    }
}

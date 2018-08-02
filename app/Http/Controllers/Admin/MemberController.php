<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    /**
     * 会员列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //取得所有参数
        $keyword = $request->input("keyword");
        //得到所有数据并搜索分页
        $members = Member::where("username", "like", "%$keyword%")->paginate(3);
        //显示视图并传递数据
        return view("admin.member.index", compact("members"));
    }

    /**
     * 会员详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //通过id找到对象
        $member = Member::find($id);
        $orderId = Order::where('user_id', $id)->pluck('id')->toArray();
        $goods = OrderGood::whereIn('order_id', $orderId)->paginate(3);
        //显示视图并传递数据
        return view("admin.member.show", compact("member", 'goods'));
    }

    /**
     * 充值
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function money(Request $request, $id)
    {
        //通过id找到对象
        $member = Member::find($id);
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //充值
            $member->money += $request->post('money');
            if ($member->save()) {
                //提示
                $request->session()->flash('success', "充值成功");
                //跳转
                return redirect()->route('member.index');
            }
        }
        //显示视图
        return view("admin.member.money");
    }
}

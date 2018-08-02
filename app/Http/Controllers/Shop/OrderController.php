<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use App\Models\Order;
use App\Models\OrderGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * 订单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        //取出当前用户的所有订单
        $orders = Order::where('shop_id', $shopId)->paginate(3);
        //显示视图并传递数据
        return view('shop.order.index', compact('orders'));
    }

    /**
     * 查看订单详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //得到当前订单信息
        $order = Order::find($id);
        $goods = OrderGood::where('order_id', $id)->get();
        //显示视图并传递参数
        return view('shop.order.show', compact('order', 'goods'));
    }

    /**
     * 是否发货
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request, $id)
    {
        //通过id找到对象
        $order = Order::find($id);
        if ($order->status == 1) {
            $order->status = 2;
            if ($order->save()) {
                //提示
                $request->session()->flash("success", "商家发货成功");
                //跳转
                return redirect()->route("order.index");
            } else {
                //提示
                $request->session()->flash("danger", "用户未支付");
                //跳转
                return redirect()->route("order.index");
            }
        }
    }

    /**
     * 是否取消订单
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request, $id)
    {
        //通过id找到对象
        $order = Order::find($id);
        $member = Member::find($order->user_id);
        if ($order->status == 1) {
            $order->status = -1;
            $member->money += $order->total;
            if ($order->save() && $member->save()) {
                //提示
                $request->session()->flash("success", "订单取消成功");
                //跳转
                return redirect()->route("order.index");
            } else {
                //提示
                $request->session()->flash("danger", "商家已发货，不能取消");
                //跳转
                return redirect()->route("order.index");
            }
        }
    }

    /**
     * 订单统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        //总计
        $order = Order::where('shop_id', $shopId)->select(DB::raw('SUM(total) AS money,
                count(*) AS count'))->first();
        //dd($order);
        //显示视图并传递数据
        return view('shop.order.all', compact('order'));
    }

    /**
     * 每日统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function day(Request $request)
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        $query = Order::where('shop_id', $shopId)->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS day,
	            SUM(total) AS money,count(*) AS count'))->groupBy('day')
            ->orderBy("day", 'desc')->limit(30);
        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
        if ($start != null) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end != null) {
            $query->whereDate('created_at', '<=', $end);
        }
        $days = $query->get();
        //显示视图并传递数据
        return view('shop.order.day', compact('days'));
    }

    /**
     * 每月统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function month()
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        $months = Order::where('shop_id', $shopId)->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS month,
	            SUM(total) AS money,count(*) AS count'))->groupBy('month')
            ->orderBy("month", 'desc')->limit(12)->get();
        //显示视图并传递数据
        return view('shop.order.month', compact('months'));
    }

    /**
     * 菜品销量统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu()
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        //总计
        $orderId = Order::where('shop_id', $shopId)->pluck('id')->toArray();
        $good = OrderGood::whereIn('order_id', $orderId)->SELECT(DB::raw('SUM(amount) as num'))->first();
        //显示视图并传递数据
        return view('shop.order.menu', compact('good'));
    }

    /**
     * 每日菜品销量统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menuDay(Request $request)
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        //总计
        $orderId = Order::where('shop_id', $shopId)->pluck('id')->toArray();
        //dd($orderId);
        $query = OrderGood::whereIn('order_id', $orderId)->SELECT(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS day,
                SUM(amount) as count,goods_id,goods_name'))->groupBy('day', 'goods_id')
            ->orderBy("day", 'desc')->limit(10);
        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
        if ($start != null) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end != null) {
            $query->whereDate('created_at', '<=', $end);
        }
        $days = $query->get();
        //显示视图并传递数据
        return view('shop.order.menuDay', compact('days'));
    }

    /**
     * 每月菜品销量统计
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menuMonth()
    {
        //得到当前用户的商家id
        $shopId = Auth::user()->shop_id;
        //总计
        $orderId = Order::where('shop_id', $shopId)->pluck('id')->toArray();
        //dd($orderId);
        $months = OrderGood::whereIn('order_id', $orderId)->SELECT(DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS month,
                SUM(amount) as count,goods_id,goods_name'))->groupBy('month', 'goods_id')
            ->orderBy("month", 'desc')->limit(10)->get();
        //显示视图并传递数据
        return view('shop.order.menuMonth', compact('months'));
    }
}

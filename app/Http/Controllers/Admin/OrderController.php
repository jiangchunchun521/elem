<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * 订单量统计
     * 按店铺分别统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        $shId = $shops->pluck('id')->toArray();
        //接收参数
        $shopId = $request->input('shop_id');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        $order = $query->whereIn('shop_id', $shId)
            ->select(DB::raw('SUM(total) as money,COUNT(*) as count'))->first();
        //显示视图并传递数据
        return view('admin.order.index', compact('order', 'shops'));
    }

    /**
     * 订单每日统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function day(Request $request)
    {
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        $shId = $shops->pluck('id')->toArray();
        //接收参数
        $shopId = $request->input('shop_id');
        $start = $request->input('start');
        $end = $request->input('end');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        if ($start != null) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end != null) {
            $query->whereDate('created_at', '<=', $end);
        }
        $days = $query->whereIn('shop_id', $shId)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d") as day,
            SUM(total) as money,COUNT(*) as count'))->groupBy('day')
            ->orderBy('day', 'desc')->limit(10)->get();
        //显示视图并传递数据
        return view('admin.order.day', compact('days', 'shops'));
    }

    /**
     * 订单每月统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function month(Request $request)
    {
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        $shId = $shops->pluck('id')->toArray();
        //接收参数
        $shopId = $request->input('shop_id');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        $months = $query->whereIn('shop_id', $shId)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m") as month,
            SUM(total) as money,COUNT(*) as count'))->groupBy('month')
            ->orderBy('month', 'desc')->limit(12)->get();
        //显示视图并传递数据
        return view('admin.order.month', compact('months', 'shops'));
    }

    /**
     * 菜品销量统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu(Request $request)
    {
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
       //接收参数
        $shopId = $request->input('shop_id');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        $orderId=$query->pluck('id')->toArray();
        $goods = OrderGood::whereIn('order_id', $orderId)
            ->select(DB::raw('SUM(amount) as count,goods_name'))
            ->groupBy('goods_name')->get();
        //显示视图并传递数据
        return view('admin.order.menu', compact('goods', 'shops'));
    }

    /**
     * 每日菜品销量统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menuDay(Request $request)
    {
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        //接收参数
        $shopId = $request->input('shop_id');
        $start = $request->input('start');
        $end = $request->input('end');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        if ($start != null) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end != null) {
            $query->whereDate('created_at', '<=', $end);
        }
        $orderId=$query->pluck('id')->toArray();
        $days = OrderGood::whereIn('order_id', $orderId)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m-%d") as day,
            SUM(amount) as count,goods_name'))->groupBy('goods_name','day')
            ->orderBy('day', 'desc')->limit(10)->get();
        //显示视图并传递数据
        return view('admin.order.menuDay', compact('days', 'shops'));
    }

    /**
     * 每月菜品销量统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menuMonth(Request $request)
    {
        $query = Order::orderBy('id');
        //得到所有店铺数据
        $shops = Shop::all();
        //接收参数
        $shopId = $request->input('shop_id');
        if ($shopId !== null) {
            $query->where('shop_id', $shopId);
        }
        $orderId=$query->pluck('id')->toArray();
        $months = OrderGood::whereIn('order_id', $orderId)
            ->select(DB::raw('DATE_FORMAT(created_at,"%Y-%m") as month,
            SUM(amount) as count,goods_name'))->groupBy('goods_name','month')
            ->orderBy('month', 'desc')->limit(10)->get();
        //显示视图并传递数据
        return view('admin.order.menuMonth', compact('months', 'shops'));
    }
}

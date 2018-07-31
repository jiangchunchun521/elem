<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends BaseController
{
    /**
     * 购物车列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        //得到当前用户id
        $memberId = $request->input('user_id');
        //得到当前用户购物车的数据
        $carts = Cart::where('user_id', $memberId)->get();
        //声明一个数组
        $goodsList = [];
        //声明总价格
        $totalCost = 0;
        foreach ($carts as $cart) {
            $menu = Menu::where('id', $cart->goods_id)->first(['goods_name', 'goods_img', 'goods_price']);
            $menu->goods_id = (string)$cart->goods_id;
            $menu->amount = $cart->amount;
            $totalCost += $menu->amount * $menu->goods_price;
            $goodsList[] = $menu;
        }
        //返回数据
        return [
            'goods_list' => $goodsList,
            'totalCost' => $totalCost
        ];
    }

    /**
     * 添加购物车
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        //清空购物车
        Cart::where('user_id', $request->post('user_id'))->delete();
        //验证
        $validate = Validator::make($request->post(), [
            'goodsList' => 'required',
            'goodsCount' => 'required'
        ]);
        //验证是否有错
        if ($validate->fails()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];
        }
        //接收参数
        $goods = $request->post('goodsList');
        $counts = $request->post('goodsCount');
        //循环
        foreach ($goods as $k => $good) {
            $data = [
                'user_id' => $request->post('user_id'),
                'goods_id' => $good,
                'amount' => $counts[$k]
            ];
            //插入数据
            Cart::create($data);
        }
        //返回数据
        return [
            'status' => 'true',
            'message' => '购物车添加成功'
        ];
    }
}

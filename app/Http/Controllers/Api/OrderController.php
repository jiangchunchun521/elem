<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\User;
use App\Mail\OrderShipped;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mrgoon\AliSms\AliSms;

class OrderController extends BaseController
{
    /**
     * 添加订单，订单商品
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        //得到收货地址
        $address = Address::find($request->post('address_id'));
        //判断地址
        if ($address === null) {
            return [
                'status' => 'false',
                'message' => '地址选择错误'
            ];
        }
        //得到用户id
        $data['user_id'] = $request->post('user_id');
        //得到购物车信息
        $carts = Cart::where('user_id', $request->post('user_id'))->get();
        //通过购物车的第一条数据的商品ID在菜品中找到shop_id
        $shopId = Menu::find($carts[0]->goods_id)->shop_id;
        //得到店铺id
        $data['shop_id'] = $shopId;
        //生成订单编号
        $data['sn'] = date('ymdHis') . rand(1000, 9999);
        //得到地址
        $data['provence'] = $address->provence;
        $data['city'] = $address->city;
        $data['area'] = $address->area;
        $data['detail_address'] = $address->detail_address;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        //定义总价格
        $total = 0;
        foreach ($carts as $k => $v) {
            $menu = Menu::where('id', $v->goods_id)->first();
            $total += $v->amount * $menu->goods_price;
        }
        //得到总价格
        $data['total'] = $total;
        //设置状态为代付款
        $data['status'] = 0;
        //事务启动
        DB::beginTransaction();
        try {
            //插入订单数据
            $order = Order::create($data);
            //添加订单商品
            foreach ($carts as $k1 => $v1) {
                //得到当前菜品
                $menu = Menu::find($v1->goods_id);
                //给各字段赋值
                $dataGoods['order_id'] = $order->id;
                $dataGoods['goods_id'] = $v1->goods_id;
                $dataGoods['amount'] = $v1->amount;
                $dataGoods['goods_name'] = $menu->goods_name;
                $dataGoods['goods_img'] = $menu->goods_img;
                $dataGoods['goods_price'] = $menu->goods_price;
                //插入订单商品数据
                OrderGood::create($dataGoods);
            }
            //清空购物车
            Cart::where('user_id', $request->post('user_id'))->delete();
            //提交
            DB::commit();
        } catch (QueryException $exception) {
            //回滚
            DB::rollBack();
            //返回数据
            return [
                "status" => "false",
                "message" => $exception->getMessage()
            ];
        }
        /*$user = User::where('shop_id', $order->shop_id)->first();
        //通过审核发送邮件
        Mail::to($user)->send(new OrderShipped($order));*/
        return [
            'status' => 'true',
            'message' => '订单，订单商品添加成功',
            'order_id' => $order->id
        ];
    }

    /**
     * 订单列表
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        //得到所有订单信息
        $orders = Order::where('user_id', $request->input('user_id'))->get();
        //声明一个空数组
        $datas = [];
        //循环取出数据
        foreach ($orders as $order) {
            $data['id'] = $order->id;
            $data['order_code'] = $order->sn;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] = $order->order_status;
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->goods;
            $datas[] = $data;
        }
        //返回数据
        return $datas;
    }

    /**
     * 订单详情
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        //得到当前订单
        $order = Order::find($request->input('id'));
        //得到各字段的值
        $data['id'] = $order->id;
        $data['order_code'] = $order->sn;
        $data['order_birth_time'] = (string)$order->created_at;
        $data['order_status'] = $order->order_status;
        $data['shop_id'] = (string)$order->shop_id;
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['goods_list'] = $order->goods;
        //返回数据
        return $data;
    }

    /**
     * 支付金额
     * @param Request $request
     * @return array
     */
    public function pay(Request $request)
    {
        //得到当前订单信息
        $order = Order::find($request->post('id'));
        //找到当前用户
        $member = Member::where('id', $order->user_id)->first();
        //判断余额
        if ($order->total > $member->money) {
            return [
                'status' => 'false',
                'message' => '您的余额已不足，请充值'
            ];
        }
        //扣钱
        $member->money = $member->money - $order->total;
        $member->jifen += 5;
        $member->save();
        //更改订单状态
        $order->status = 1;
        $order->save();
        //配置 发短信
        $config = [
            'access_key' => 'LTAIZOaBhGHVz35m',
            'access_secret' => 'cGqV0fITIAIm7l1giOl2nQsaGoRqaD',
            'sign_name' => '蒋春容',
        ];
        $aliSms = new AliSms();
        $aliSms->sendSms($member->tel, 'SMS_141670132', ['product' => $order->sn], $config);
        //dd($response);
        return [
            'status' => 'true',
            'message' => '支付成功'
        ];
    }
}

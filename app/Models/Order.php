<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //设置可修改字段
    public $fillable = ['user_id', 'shop_id', 'sn', 'tel', 'name', 'provence', 'city', 'area',
        'detail_address', 'total', 'status', 'out_trade_no'];

    //订单状态
    public function getOrderStatusAttribute()
    {
        $arr = [-1 => '已取消', 0 => '代付款', 1 => '待发货', 2 => '待确认', 3 => '完成'];
        return $arr[$this->status];
    }

    //通过订单找到商家
    public function shop()
    {
        return $this->belongsTo(Shop::class, "shop_id");
    }

    //通过订单找到商品
    public function goods()
    {
        return $this->hasMany(OrderGood::class, "order_id");
    }

    //通过订单找到用户
    public function member()
    {
        return $this->belongsTo(Member::class, "user_id");
    }
}

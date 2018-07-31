<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGood extends Model
{
    //设置可修改字段
    public $fillable = ['order_id', 'goods_id', 'amount', 'goods_name', 'goods_img', 'goods_price'];
}

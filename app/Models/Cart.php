<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //设置可修改字段
    public $fillable = ['user_id', 'goods_id', 'amount'];
}

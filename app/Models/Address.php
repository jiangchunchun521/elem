<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //设置可修改字段
    public $fillable = ['user_id', 'tel', 'name', 'provence', 'city', 'area',
        'detail_address', 'is_default'];
}

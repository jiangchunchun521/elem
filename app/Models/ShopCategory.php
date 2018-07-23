<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    //设置可修改字段
    public $fillable = ['name', 'logo', 'status'];
}

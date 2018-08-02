<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //设置可修改字段
    public $fillable = ['username', 'password', 'tel', 'money', 'jifen'];
}

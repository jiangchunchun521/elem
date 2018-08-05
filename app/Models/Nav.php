<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    //设置可修改字段
    public $fillable = ['name', 'url', 'parent_id', 'sort'];
}

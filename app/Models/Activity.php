<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //设置可修改字段
    public $fillable = ['title', 'content', 'start_time', 'end_time'];
}

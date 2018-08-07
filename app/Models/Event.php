<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //设置可修改字段
    public $fillable = ['title', 'content', 'start', 'end', 'prize_date', 'num', 'is_prize'];
}

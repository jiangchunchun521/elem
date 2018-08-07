<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    //设置可修改字段
    public $fillable = ['event_id', 'user_id'];

    //找到报名的抽奖活动
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    //找到报名商户
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

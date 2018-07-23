<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['name', 'email', 'password', 'status', 'shop_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //通过商户找店铺
    public function shop()
    {
        return $this->hasOne(Shop::class, "id");
    }

    //通过商家找店铺类型
    public function cate()
    {
        return $this->belongsTo(ShopCategory::class, 'shop_cate_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //设置可修改字段
    public $fillable = ['category_id', 'goods_name', 'rating', 'shop_id',
        'goods_price', 'description', 'month_sales', 'rating_count',
        'tips', 'satisfy_count', 'satisfy_rate', 'goods_img', 'status'];

    //通过菜品找菜品类型
    public function mCate()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }
}

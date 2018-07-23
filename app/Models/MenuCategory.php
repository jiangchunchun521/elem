<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //设置可修改字段
    public $fillable = ['name', 'type_accumulation', 'shop_id', 'description', 'is_selected'];

    //通过菜品类型找菜品
    public function menu()
    {
        return $this->hasMany(Menu::class, 'id');
    }
}

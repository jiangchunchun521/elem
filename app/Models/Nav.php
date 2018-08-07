<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nav extends Model
{
    //设置可修改字段
    public $fillable = ['name', 'url', 'parent_id', 'sort'];

    /*public static function navs()
    {
        //得到所有儿子分类
        $navs = self::where('parent_id', 0)->get();
        foreach ($navs as $k => $nav) {
            //1.把没有儿子的当前分类删除掉
            if (self::where("parent_id", $nav->id)->first() === null) {
                //删除当前分类
                unset($navs[$k]);
                //跳出当前本次循环
                continue;
            }
            //得到所有儿子分类的权限
            $childs = self::where('parent_id', $nav->id)->get();
            foreach ($childs as $v) {
                $ok = 0;
                //判断儿子有没有权限
                if (Auth::guard('admin')->user()->can($v->url)) {
                    //有权限
                    $ok = 1;
                }
                //如果$ok===0 就说明没有儿子有权限 就把当前分类的删除
                if ($ok === 0 && Auth::guard('admin')->user()->id != 1) {
                    unset($navs[$k]);
                }
            }
        }
        return $navs;
    }*/
}

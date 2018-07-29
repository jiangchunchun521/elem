<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{
    /**
     * 提供店铺列表
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $keyword = $request->input('keyword') ? $request->input('keyword') : "";
        //得到状态为正常的店铺信息
        $shops = Shop::where('status', 1)->where('shop_name', 'like', "%$keyword%")->get();
        //dump($shops);
        //循环取出
        foreach ($shops as $shop) {
            $shop->distance = rand(1000, 4000);
            $shop->estimate_time = $shop->distance / 100;
        }
        return $shops;
    }

    /**
     * 菜品信息
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        //店铺id
        $id = $request->input('id');
        //得到店铺信息
        $shop = Shop::findOrFail($id);
        //给店铺添加没用过的
        $shop->distance = rand(1000, 4000);
        $shop->estimate_time = $shop->distance / 100;
        //添加评论
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2018-7-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],
            [
                "user_id" => 12355,
                "username" => "s******j",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2018-7-24",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"]
        ];
        //取出菜品分类
        $cates = MenuCategory::where('shop_id', $id)->get();
        //循环取出当前菜品分类下的所有菜品
        foreach ($cates as $cate) {
            $cate->goods_list = Menu::where('category_id', $cate->id)->get();
        }
        /*foreach ($cate->goods_list as $k => $v) {
            $cate->goods_list[$k]->goods_id = $v->id;
        }*/
        //把分类数据追加到shop
        $shop->commodity = $cates;
        return $shop;
    }
}

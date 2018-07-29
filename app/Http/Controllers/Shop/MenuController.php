<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MenuController extends BaseController
{
    /**
     * 菜品列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $shopId = Auth::user()->shop_id;
        $shop = Shop::where('id', '=', $shopId)->first();
        //得到所有菜品类型
        $cates = MenuCategory::all();
        //接收参数
        $categoryId = $request->input('category_id');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $keyword = $request->input('keyword');
        $query = Menu::orderBy('id');
        if ($categoryId !== null) {
            $query->where('category_id', '=', $categoryId);
        }
        if ($minPrice !== null) {
            $query->where('goods_price', '>=', $minPrice);
        }
        if ($minPrice !== null && $maxPrice !== null) {
            $query->where('goods_price', '>=', $minPrice)
                ->where('goods_price', '<=', $maxPrice);
        }
        if ($maxPrice !== null) {
            $query->where('goods_price', '<=', $maxPrice);
        }
        if ($keyword !== null) {
            $query->where('goods_name', 'like', "%{$keyword}%");
        }
        //得到所有数据并搜索分页
        $menus = $query->where('shop_id',$shopId)->paginate(3);
        //显示视图并传递数据
        return view("shop.menu.index", compact("menus", "shop", "cates"));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $shopId = Auth::user()->shop_id;
        //得到所有店铺类型
        $cates = MenuCategory::where('shop_id',$shopId)->get();
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'category_id' => "required|integer",
                'goods_name' => "required",
                'rating' => "required|numeric",
                'goods_price' => "required|numeric",
                'satisfy_rate' => "required|numeric",
                'month_sales' => "required|integer",
                'rating_count' => "required|integer",
                'satisfy_count' => "required|integer",
                'captcha' => "required|captcha"
            ]);
            $data = $request->all();
            $data['shop_id'] = $shopId;
            $data['goods_img'] = "";
            //判断是否上传图片
            if ($request->file("goods_img")) {
                //在data里追加上传的图片
                $data['goods_img'] = $request->file("goods_img")->store("uploads/menus", "images");
            }
            //插入数据
            Menu::create($data);
            //提示
            $request->session()->flash("success", "菜品添加成功");
            //跳转
            return redirect()->route("menu.index");
        }
        //显示视图并传递数据
        return view("shop.menu.add", compact("cates"));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $shopId = Auth::user()->shop_id;
        //通过id找到对象
        $menu = Menu::find($id);
        //得到所有店铺类型
        $cates = MenuCategory::where('shop_id',$shopId)->get();
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'category_id' => "required|integer",
                'goods_name' => "required",
                'rating' => "required|numeric",
                'goods_price' => "required|numeric",
                'satisfy_rate' => "required|numeric",
                'month_sales' => "required|integer",
                'rating_count' => "required|integer",
                'satisfy_count' => "required|integer"
            ]);
            $data = $request->all();
            //上传新图片
            if (isset($data['goods_img'])) {
                $fileName = $request->file("goods_img")->store("uploads/menus", "images");
            }
            //在data里追加上传的图片
            $data['goods_img'] = $fileName ?? "";
            if ($data['goods_img'] == "") {
                //保持原图片不变
                $data['goods_img'] = $menu->goods_img;
            } else {
                File::delete($menu->goods_img);
            }
            //更新数据
            $menu->update($data);
            //提示
            $request->session()->flash("success", "菜品编辑成功");
            //跳转
            return redirect()->route("menu.index");
        }
        //显示视图并传递数据
        return view("shop.menu.edit", compact("menu", "cates"));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $menu = Menu::findOrFail($id);
        //删除数据
        $menu->delete();
        File::delete($menu->goods_img);
        //提示
        $request->session()->flash("success", "菜品删除成功");
        //跳转
        return redirect()->route("menu.index");
    }
}

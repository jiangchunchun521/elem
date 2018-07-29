<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoryController extends BaseController
{
    /**
     * 菜品分类列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shopId = Auth::user()->shop_id;
        $shop = Shop::where('id', '=', $shopId)->first();
        //dd($shopName);
        $cates = MenuCategory::where('shop_id', $shopId)->paginate(3);
        //显示视图并传递数据
        return view("shop.menu_category.index", compact("cates", "shop"));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $shopId = Auth::user()->shop_id;
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'captcha' => "required|captcha"
            ]);
            $data = $request->all();
            $data['shop_id'] = $shopId;
            //判断
            if ($request->post('is_selected')) {
                //把表里所的is_selected设置0
                MenuCategory::where("is_selected", 1)->where('shop_id', $shopId)->update(['is_selected' => 0]);
            }
            //插入数据
            MenuCategory::create($data);
            //提示
            $request->session()->flash("success", "菜品分类添加成功");
            //跳转
            return redirect()->route("menu_category.index");
        }
        //显示视图
        return view("shop.menu_category.add");
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $cate = MenuCategory::find($id);
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required"
            ]);
            //接收数据
            $data = $request->all();
            //更新数据
            $cate->update($data);
            //提示
            $request->session()->flash("success", "菜品分类编辑成功");
            //跳转
            return redirect()->route("menu_category.index");
        }
        //显示视图并传递数据
        return view("shop.menu_category.edit", compact("cate"));
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
        $cate = MenuCategory::findOrFail($id);
        $menu = Menu::where('category_id', '=', $id)->first();
        //dd($menu['category_id']);
        if ($menu['category_id'] == $id) {
            //提示
            $request->session()->flash("info", "该类型有菜品,不能删除");
            //跳转
            return redirect()->back();
        }
        //删除数据
        $cate->delete();
        //提示
        $request->session()->flash("success", "菜品分类删除成功");
        //跳转
        return redirect()->route("menu_category.index");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends BaseController
{
    /**
     * 店铺分类列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cates = ShopCategory::paginate(3);
        //显示视图并传递数据
        return view("admin.shop_category.index", compact("cates"));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'captcha' => "required|captcha"
            ]);
            $data = $request->all();
            $data['logo'] = "";
            //判断是否上传图片
            if ($request->file("logo")) {
                //在data里追加上传的图片
                $data['logo'] = $request->file("logo")->store("uploads/shop_categories", "images");
            }
            //插入数据
            ShopCategory::create($data);
            //提示
            $request->session()->flash("success", "店铺分类添加成功");
            //跳转
            return redirect()->route("shop_category.index");
        }
        //显示视图
        return view("admin.shop_category.add");
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
        $cate = ShopCategory::find($id);
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required"
            ]);
            //接收数据
            $data = $request->all();
            //上传新图片
            if (isset($data['logo'])) {
                $fileName = $request->file("logo")->store("uploads/shop_categories", "images");
            }
            //在data里追加上传的图片
            $data['logo'] = $fileName ?? "";
            if ($data['logo'] == "") {
                //保持原图片不变
                $data['logo'] = $cate->logo;
            } else {
                @unlink($cate->logo);
            }
            //更新数据
            $cate->update($data);
            //提示
            $request->session()->flash("success", "店铺分类编辑成功");
            //跳转
            return redirect()->route("shop_category.index");
        }
        //显示视图并传递数据
        return view("admin.shop_category.edit", compact("cate"));
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
        $cate = ShopCategory::findOrFail($id);
        //删除数据
        $cate->delete();
        @unlink($cate->logo);
        //提示
        $request->session()->flash("success", "店铺分类删除成功");
        //跳转
        return redirect()->route("shop_category.index");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ShopShipped;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ShopController extends BaseController
{
    /**
     * 商家列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //取得所有参数
        $query = $request->query();
        $keyword = $request->input("keyword");
        //得到所有数据并搜索分页
        $shops = Shop::where("shop_name", "like", "%$keyword%")
            ->orWhere("shop_rating", ">", "$keyword")
            ->paginate(3);
        //显示视图并传递数据
        return view("admin.shop.index", compact("shops", "query"));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //得到所有店铺类型
        $cates = ShopCategory::all();
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'shop_cate_id' => "required|integer",
                'shop_name' => "required",
                'shop_rating' => "required|numeric",
                'start_send' => "required|numeric",
                'send_cost' => "required|numeric",
                'name' => "required",
                'email' => "required|email|unique:users|max:255",
                'password' => "required|confirmed|min:6",
                'captcha' => "required|captcha"
            ]);
            $data = $request->all();
            $data['status'] = 1;
            $data['shop_img'] = "";
            //判断是否上传图片
            if ($request->file("shop_img")) {
                //在data里追加上传的图片
                $data['shop_img'] = $request->file("shop_img")->store("uploads/shops", "images");
            }
            //插入数据
            $shop = Shop::create($data);
            User::create([
                'name' => $request->post("name"),
                'email' => $request->post("email"),
                'password' => bcrypt($request->post("password")),
                'status' => 1,
                'shop_id' => $shop->id
            ]);
            //提示
            $request->session()->flash("success", "商家信息添加成功");
            //跳转
            return redirect()->route("shop.index");
        }
        //显示视图并传递数据
        return view("admin.shop.add", compact("cates"));
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
        $shop = Shop::find($id);
        //得到所有店铺类型
        $cates = ShopCategory::all();
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'shop_cate_id' => "required|integer",
                'shop_name' => "required",
                'shop_rating' => "required|numeric",
                'start_send' => "required|numeric",
                'send_cost' => "required|numeric"
            ]);
            $data = $request->all();
            //上传新图片
            if (isset($data['shop_img'])) {
                $fileName = $request->file("shop_img")->store("uploads/shops", "images");
            }
            //在data里追加上传的图片
            $data['shop_img'] = $fileName ?? "";
            if ($data['shop_img'] == "") {
                //保持原图片不变
                $data['shop_img'] = $shop->shop_img;
            } else {
                File::delete($shop->shop_img);
            }
            //更新数据
            $shop->update($data);
            //提示
            $request->session()->flash("success", "商家信息编辑成功");
            //跳转
            return redirect()->route("shop.index");
        }
        //显示视图并传递数据
        return view("admin.shop.edit", compact("shop", "cates"));
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
        $shop = Shop::findOrFail($id);
        $user = User::findOrFail($id);
        //删除数据
        $shop->delete();
        File::delete($shop->shop_img);
        $user->delete();
        //提示
        $request->session()->flash("success", "商家信息删除成功");
        //跳转
        return redirect()->route("shop.index");
    }

    /**
     * 审核
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function check(Request $request, $id)
    {
        //通过id找到对象
        $shop = Shop::find($id);
        $user = User::find($id);
        $shop->status = 1;
        $user->status = 1;
        if ($shop->update($request->all()) && $user->update($request->all())) {
            //通过审核发送邮件
            Mail::to($user)->send(new ShopShipped($shop));
            //提示
            $request->session()->flash("success", "商家信息审核成功");
            //跳转
            return redirect()->route("shop.index");
        } else {
            $shop->status = -1;
            //提示
            $request->session()->flash("success", "商家信息审核失败");
            //跳转
            return redirect()->route("shop.index");
        }
    }
}

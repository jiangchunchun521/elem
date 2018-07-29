<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * 商户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shopId = Auth::user()->shop_id;
        $users = User::where('id', '=', Auth::user()->id)->paginate(3);
        $shops = Shop::where('id', '=', $shopId)->paginate(3);
        //显示视图并传递数据
        return view("shop.user.index", compact("users", "shops"));
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'password' => "required"
            ]);
            //登录
            if (Auth::attempt(["name" => $request->post("name"), "password" => $request->post("password")], $request->has('remember'))) {
                //提示
                $request->session()->flash("success", "商户登录成功");
                //跳转  intended有来路，就跳来路，没有跳默认页
                return redirect()->intended(route("user.index"));
            } else {
                //提示
                $request->session()->flash("danger", "账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示视图并传递参数
        return view("shop.user.login");
    }

    /**
     * 注销
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        //提示
        $request->session()->flash("success", "退出成功");
        //跳转
        return redirect()->route("user.login");
    }

    /**
     * 重置密码
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function modify(Request $request)
    {
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'old_password' => "required",
                'password' => "required|confirmed|min:6"
            ]);
            $id = Auth::user()->id;
            //查询数据
            $user = User::select("password")->where("id", "=", $id)->first();
            $old_password = $request->post("old_password");
            if (!Hash::check($old_password, $user->password)) {
                //提示
                $request->session()->flash("danger", "旧密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
            $password = bcrypt($request->post("password"));
            //更新数据
            $result = User::where('id', '=', $id)->update(['password' => $password]);
            if ($result) {
                //提示
                $request->session()->flash("success", "密码修改成功");
                Auth::logout();
                //跳转
                return redirect()->route("user.login");
            } else {
                //提示
                $request->session()->flash("danger", "密码输入错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示视图
        return view("shop.user.modify");
    }

    /**
     * 注册
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function reg(Request $request)
    {
        //得到所有店铺名称
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
            $data['status'] = 0;
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
                'status' => 0,
                'shop_id' => $shop->id
            ]);
            //提示
            $request->session()->flash("success", "商户注册成功");
            //跳转
            return redirect()->route("user.login");
        }
        //显示视图并传递数据
        return view("shop.user.reg", compact("cates"));
    }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    /*public function edit(Request $request, $id)
    {
        //通过id找到对象
        $user = User::find($id);
        $shop=Shop::find($id);
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'email' => "required|email|max:255",
                'password' => "required|confirmed|min:4",
                'shop_id' => "required|integer"
            ]);
            //更新数据
            $user->update($request->all());
            $shop->update($request->all());
            //提示
            $request->session()->flash("success", "商户编辑成功");
            //跳转
            return redirect()->route("user.index");
        }
        //显示视图并传递数据
        return view("shop.user.edit", compact("user","shop"));
    }*/

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    /* public function del(Request $request,$id)
     {
         //通过id找到对象
         $user = User::findOrFail($id);
         $shop = Shop::findOrFail($id);
         //删除数据
         $user->delete();
         $shop->delete();
         @unlink($shop->shop_img);
         //提示
         $request->session()->flash("success", "商户删除成功");
         //跳转
         return redirect()->route("user.index");
     }*/
}

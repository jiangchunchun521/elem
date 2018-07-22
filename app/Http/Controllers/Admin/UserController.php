<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    /**
     * 商户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(3);
        //显示视图并传递数据
        return view("admin.user.index", compact("users"));
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
        $user = User::find($id);
        $shop=Shop::find($id);
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'email' => "required|email|max:255",
                'password' => "required|confirmed|min:6"
            ]);
            $data=$request->all();
            $data['password']=bcrypt($data['password']);
            //更新数据
            $user->update($data);
            $shop->update($request->all());
            //提示
            $request->session()->flash("success", "商户编辑成功");
            //跳转
            return redirect()->route("users.index");
        }
        //显示视图并传递数据
        return view("admin.user.edit", compact("user","shop"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id)
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
        return redirect()->route("users.index");
    }
}

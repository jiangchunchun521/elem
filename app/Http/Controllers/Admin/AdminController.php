<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admins = Admin::orderBy('id')->paginate(3);
        //显示视图并传递参数
        return view("admin.admin.index", compact("admins"));
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
            if (Auth::guard('admin')->attempt(["name" => $request->post("name"), "password" => $request->post("password")], $request->has('remember'))) {
                //提示
                $request->session()->flash("success", "管理员登录成功");
                //跳转  intended有来路，就跳来路，没有跳默认页
                return redirect()->intended(route("admin.index"));
            } else {
                //提示
                $request->session()->flash("danger", "账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示视图
        return view("admin.admin.login");
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
        return redirect()->route("admin.login");
    }

    /**
     * 修改个人密码
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
            $id = Auth::guard("admin")->user()->id;
            //查询数据
            $admin = Admin::select("password")->where("id", "=", $id)->first();
            $old_password = $request->post("old_password");
            if (!Hash::check($old_password, $admin->password)) {
                //提示
                $request->session()->flash("danger", "旧密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
            $password = bcrypt($request->post("password"));
            //更新数据
            $result = Admin::where('id', '=', $id)->update(['password' => $password]);
            if ($result) {
                //提示
                $request->session()->flash("success", "密码修改成功");
                Auth::logout();
                //跳转
                return redirect()->route("admin.login");
            } else {
                //提示
                $request->session()->flash("danger", "密码输入错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
        //显示视图
        return view("admin.admin.modify");
    }

    /**
     * 注册
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function reg(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'email' => "required|email|max:255",
                'password' => "required|confirmed|min:6",
                'captcha' => "required|captcha"
            ]);
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            //插入数据
            $admin = Admin::create($data);
            //给用户对象添加角色 同步角色
            $admin->syncRoles($request->post('role'));
            //提示
            $request->session()->flash("success", '添加' . $admin->name . '成功');
            //跳转
            return redirect()->route("admin.login");
        }
        //得到所有角色
        $roles = Role::all();
        //显示视图
        return view("admin.admin.reg", compact('roles'));
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
        $admin = Admin::find($id);
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'name' => "required",
                'email' => "required|email|max:255"
            ]);
            //更新数据
            $admin->update($request->all());
            //给用户对象添加角色 同步角色
            $admin->syncRoles($request->post('role'));
            //提示
            $request->session()->flash("success", "管理员编辑成功");
            //跳转
            return redirect()->route("admin.index");
        }
        $roles = Role::all();
        //显示视图并传递数据
        return view("admin.admin.edit", compact("admin", 'roles'));
    }

    /**
     * 删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        if ($id == 1) {
            //跳转
            return back()->with("info", "超级管理员不能删除");
        }
        //通过id找到对象
        $admin = Admin::findOrFail($id);
        //删除数据
        $admin->delete();
        //提示
        $request->session()->flash("success", "管理员删除成功");
        //跳转
        return redirect()->route("admin.index");
    }
}

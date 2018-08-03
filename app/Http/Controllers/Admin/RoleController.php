<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    /**
     * 角色列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //得到所有角色
        $roles = Role::paginate(3);
        //显示视图并传递数据
        return view('admin.role.index', compact('roles'));
    }

    /**
     * 添加角色
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        //判断是不是 post提交
        if ($request->isMethod('post')) {
            //接收参数
            $data['name'] = $request->post('name');
            $data['guard_name'] = 'admin';
            //插入角色数据
            $role = Role::create($data);
            //给角色添加权限 $role->syncPermissions(['权限名1','权限名2']);
            $role->syncPermissions($request->post('per'));
            //提示
            $request->session()->flash('success', '添加角色' . $role->name . '成功');
            //跳转
            return redirect()->route('role.index');
        }
        //得到所有权限
        $pers = Permission::all();
        //显示视图并传递数据
        return view('admin.role.add', compact('pers'));
    }

    /**
     * 编辑角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到对象
        $role = Role::find($id);
        //判断是不是 post提交
        if ($request->isMethod('post')) {
            //接收参数
            $data['name'] = $request->post('name');
            //插入角色数据
            $role->update($data);
            //给角色添加权限 $role->syncPermissions(['权限名1','权限名2']);
            $role->syncPermissions($request->post('per'));
            //提示
            $request->session()->flash('success', '该角色修改成功');
            //跳转
            return redirect()->route('role.index');
        }
        //得到所有权限
        $pers = Permission::all();
        //显示视图并传递数据
        return view('admin.role.edit', compact('role', 'pers'));
    }

    /**
     * 删除角色
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $role = Role::findOrFail($id);
        //删除数据
        $role->delete();
        //提示
        $request->session()->flash('success', '该角色删除成功');
        //跳转
        return redirect()->route('role.index');
    }
}

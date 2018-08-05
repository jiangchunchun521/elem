<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    /**
     * 权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //得到所有数据
        $pers = Permission::paginate(3);
        //显示视图并传递数据
        return view('admin.per.index', compact('pers'));
    }

    /**
     * 添加权限
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'name' => 'required|unique:permissions'
            ]);
            $name = $request->post('name');
            //添加一个权限  权限名称必需是路由的名称  后面做权限判断
            $per = Permission::create(['name' => $name, 'guard_name' => 'admin']);
            //提示
            $request->session()->flash('success', "该权限添加成功");
            //跳转
            return redirect()->route('per.index');
        }
        //得到所有路由
        $routes = Route::getRoutes();
        //定义数组
        $urls = [];
        foreach ($routes as $route) {
            if (isset($route->action['namespace'])) {
                if ($route->action['namespace'] === "App\Http\Controllers\Admin") {
                    if (isset($route->action['as'])) {
                        $urls[] = $route->action['as'];
                    }
                }
            }
        }
        //dump($urls);
        //显示视图并传递数据
        return view('admin.per.add',compact('urls'));
    }

    /**
     * 删除权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        //通过id找到对象
        $per = Permission::findOrFail($id);
        //删除数据
        $per->delete();
        //提示
        $request->session()->flash('success', "该权限删除成功");
        //跳转
        return redirect()->route('per.index');
    }
}

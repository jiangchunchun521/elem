<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends Controller
{
    /**
     * 导航菜单列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $navs = Nav::paginate(6);
        //显示视图并传递数据
        return view('admin.nav.index', compact('navs'));
    }

    /**
     * 添加导航菜单
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //判断是不是post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                'name' => 'required'
            ]);
            if ($request->post('url') === null) {
                $data = $request->except('url');
            } else {
                $data = $request->post();
            }
            //插入数据
            $nav = Nav::create($data);
            //跳转并提示
            return redirect()->refresh()->with('success', '添加导航菜单' . $nav->name . '成功');
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
        $navs = Nav::where('parent_id', 0)->get();
        return view('admin.nav.add', compact('urls', 'navs'));
    }
}

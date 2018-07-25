<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends BaseController
{
    /**
     * 活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $activitys = Activity::paginate(3);
        //显示视图并传递数据
        return view("admin.activity.index", compact("activitys"));
    }

    /**
     * 未开始活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unStart()
    {
        //得到当前时间
        $time = date("Y-m-d", time());
        $activitys = Activity::whereDate('start_time', '>', $time)->paginate(3);
        //显示视图并传递数据
        return view("admin.activity.index", compact("activitys"));
    }

    /**
     * 进行中活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function going()
    {
        //得到当前时间
        $time = date("Y-m-d", time());
        $activitys = Activity::whereDate('start_time', '<=', $time)
            ->whereDate('end_time', '>=', $time)
            ->paginate(3);
        //显示视图并传递数据
        return view("admin.activity.index", compact("activitys"));
    }

    /**
     * 已结束活动列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function over()
    {
        //得到当前时间
        $time = date("Y-m-d", time());
        $activitys = Activity::whereDate('end_time', '<', $time)->paginate(3);
        //显示视图并传递数据
        return view("admin.activity.index", compact("activitys"));
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
                'title' => "required",
                'content' => "required",
                'start_time' => "required",
                'end_time' => "required"
            ]);
            //插入数据
            Activity::create($request->all());
            //提示
            $request->session()->flash("success", "活动添加成功");
            //跳转
            return redirect()->route("activities.index");
        }
        //显示视图
        return view("admin.activity.add");
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
        $activity = Activity::find($id);
        //判断是不是post提交
        if ($request->isMethod("post")) {
            //验证
            $this->validate($request, [
                'title' => "required",
                'content' => "required",
                'start_time' => "required",
                'end_time' => "required"
            ]);
            //更新数据
            $activity->update($request->all());
            //提示
            $request->session()->flash("success", "活动编辑成功");
            //跳转
            return redirect()->route("activities.index");
        }
        //显示视图并传递数据
        return view("admin.activity.edit", compact("activity"));
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
        $activity = Activity::findOrFail($id);
        //删除数据
        $activity->delete();
        //提示
        $request->session()->flash("success", "活动删除成功");
        //跳转
        return redirect()->route("activities.index");
    }
}

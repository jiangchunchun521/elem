@extends("layouts.admin.default")
@section("title","添加导航菜单")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-sm-2 control-label">导航菜单名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="请输入名称">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">导航菜单地址</label>
            <div class="col-sm-10">
                <select class="form-control" name="url">
                    <option value="0">请选择导航菜单地址</option>
                    @foreach($urls as $url)
                        <option>{{$url}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">上级菜单名称</label>
            <div class="col-sm-10">
                <select class="form-control" name="parent_id">
                    <option value="0">顶级分类</option>
                    @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-10">
                <input type="text" name="sort" class="form-control" value="100">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
                <a href="{{route('nav.index')}}" class="btn btn-info">导航菜单列表</a>
            </div>
        </div>
    </form>
@endsection
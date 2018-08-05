@extends("layouts.admin.default")
@section("title","添加权限")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-sm-2 control-label">权限名称</label>
            <div class="col-sm-10">
                <select class="form-control" name="name">
                    <option value="0">请选择权限名称</option>
                    @foreach($urls as $url)
                        <option>{{$url}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
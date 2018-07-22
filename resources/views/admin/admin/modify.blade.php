@extends("layouts.admin.default")
@section("title","修改个人密码")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="old_password" class="col-sm-2 control-label">旧密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('old_password')}}" class="form-control"
                       placeholder="请输入旧密码" name="old_password">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">新密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('password')}}" class="form-control"
                       placeholder="请输入新密码" name="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">确认新密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('password_confirmation')}}" class="form-control"
                       placeholder="请再次输入新密码" name="password_confirmation">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
@extends("layouts.shop.default")
@section("title","重置密码")
@section("content")
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">重置密码</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}
            <div class="box-body">
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
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">提交</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection
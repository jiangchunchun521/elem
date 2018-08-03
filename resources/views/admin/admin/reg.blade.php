@extends("layouts.admin.default")
@section("title","添加管理员")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">管理员姓名</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name')}}" class="form-control" id="name"
                       placeholder="请输入管理员姓名"
                       name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" value="{{old('email')}}" class="form-control" name="email"
                       placeholder="请输入Email地址">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('password')}}" class="form-control" id="password"
                       placeholder="请输入密码"
                       name="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">确认新密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('password_confirmation')}}" class="form-control"
                       id="password" placeholder="请输入确认密码"
                       name="password_confirmation">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-10">
                @foreach($roles as $role)
                    <input type="checkbox" name="role[]" value="{{$role->name}}">{{$role->name}}
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="captcha" class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-1">
                <input id="captcha" class="form-control" name="captcha">
            </div>
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}"
                 onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
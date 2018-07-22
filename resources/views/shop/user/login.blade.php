@extends("layouts.shop.default")
@section("title","商户登录")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">商户姓名</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name')}}" class="form-control" id="name"
                       placeholder="请输入商户姓名"
                       name="name">
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
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> 记住我
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">登录</button>
                <a href="{{route('user.reg')}}" class="btn btn-primary">注册</a>
            </div>
        </div>
    </form>
@endsection
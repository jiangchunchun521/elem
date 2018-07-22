@extends("layouts.admin.default")
@section("title","编辑商户")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">商户姓名</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name',$user->name)}}" class="form-control" id="name"
                       placeholder="请输入用户名"
                       name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" value="{{old('email',$user->email)}}" class="form-control" name="email"
                       placeholder="请输入Email地址">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('password',$user->password)}}" class="form-control" id="password"
                       placeholder="请输入密码"
                       name="password">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">确认新密码</label>
            <div class="col-sm-10">
                <input type="password" value="{{old('password_confirmation',$user->password)}}" class="form-control"
                       id="password" placeholder="请输入确认密码"
                       name="password_confirmation">
            </div>
        </div>
        <div class="form-group">
            <label for="shop_name" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('shop_name',$shop->shop_name)}}" class="form-control" id="name"
                       placeholder="请输入用户名"
                       name="shop_name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
@extends("layouts.admin.default")
@section("title","充值")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="money" class="col-sm-2 control-label">充值金额</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('money')}}" class="form-control" placeholder="请输入金额"
                       name="money">
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
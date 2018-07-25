@extends("layouts.admin.default")
@section("title","添加活动")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('title')}}" class="form-control" placeholder="请输入活动名称"
                       name="title">
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>
                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain"></script>
            </div>
        </div>
        <div class="form-group">
            <label for="start_time" class="col-sm-2 control-label">活动开始时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('start_time')}}" class="form-control" placeholder="请输入活动开始时间"
                       name="start_time">
            </div>
        </div>
        <div class="form-group">
            <label for="end_time" class="col-sm-2 control-label">活动结束时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('end_time')}}" class="form-control" placeholder="请输入活动结束时间"
                       name="end_time">
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
@extends("layouts.admin.default")
@section("title","编辑活动")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('title',$activity->title)}}" class="form-control" placeholder="请输入活动名称"
                       name="title">
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function () {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>
                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain">{!!$activity->content!!}</script>
            </div>
        </div>
        <div class="form-group">
            <label for="start_time" class="col-sm-2 control-label">活动开始时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('start_time',$activity->start_time)}}" class="form-control"
                       placeholder="请输入活动开始时间"
                       name="start_time">
            </div>
        </div>
        <div class="form-group">
            <label for="end_time" class="col-sm-2 control-label">活动结束时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('end_time',$activity->end_time)}}" class="form-control"
                       placeholder="请输入活动结束时间"
                       name="end_time">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
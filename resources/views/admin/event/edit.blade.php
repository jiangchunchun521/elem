@extends("layouts.admin.default")
@section("title","编辑抽奖活动")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('title',$event->title)}}" class="form-control" placeholder="请输入活动名称"
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
                <script id="container" name="content" type="text/plain">{!!$event->content!!}</script>
            </div>
        </div>
        <div class="form-group">
            <label for="start" class="col-sm-2 control-label">报名开始时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('start',date('Y-m-d',$event->start))}}" class="form-control" placeholder="请输入报名开始时间"
                       name="start">
            </div>
        </div>
        <div class="form-group">
            <label for="end" class="col-sm-2 control-label">报名结束时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('end',date('Y-m-d',$event->end))}}" class="form-control" placeholder="请输入报名结束时间"
                       name="end">
            </div>
        </div>
        <div class="form-group">
            <label for="prize_date" class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="date" value="{{old('prize_date',date('Y-m-d',$event->prize_date))}}" class="form-control" placeholder="请输入开奖时间"
                       name="prize_date">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
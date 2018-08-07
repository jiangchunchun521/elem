@extends("layouts.admin.default")
@section("title","添加活动奖品")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="event_id" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <select class="form-control" name="event_id">
                    <option value="0">请选择活动</option>
                    @foreach($events as $event)
                        @if(date('Y-m-d h:i:s',$event->prize_date) > date('Y-m-d h:i:s',time()))
                            <option value="{{$event->id}}">{{$event->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">奖品名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name')}}" class="form-control" placeholder="请输入奖品名称"
                       name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">奖品详情</label>
            <div class="col-sm-10">
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function () {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>
                <!-- 编辑器容器 -->
                <script id="container" name="description" type="text/plain"></script>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
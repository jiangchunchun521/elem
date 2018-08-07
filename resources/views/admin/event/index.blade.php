@extends("layouts.admin.default")
@section("title","抽奖活动列表")
@section("content")
    <a href="{{route("events.add")}}" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> 添加</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>报名人数</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{!!$event->content!!}</td>
                <td>{{date('Y-m-d h:i:s',$event->start)}}</td>
                <td>{{date('Y-m-d h:i:s',$event->end)}}</td>
                <td>{{date('Y-m-d h:i:s',$event->prize_date)}}</td>
                <td>{{$event->num}}</td>
                <td>
                    @if($event->is_prize==1)
                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    @if(date('Y-m-d h:i:s',$event->prize_date) <= date('Y-m-d h:i:s',time()))
                        <a href="{{route("events.start",$event)}}" class="btn btn-info">开始抽奖</a>
                    @endif
                    @if(date('Y-m-d h:i:s',$event->start) > date('Y-m-d h:i:s',time()))
                        <a href="{{route("events.edit",$event)}}" class="btn btn-success"><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        <a href="{{route("events.del",$event)}}" class="btn btn-danger"><i
                                    class="glyphicon glyphicon-trash"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{$events->links()}}
@endsection
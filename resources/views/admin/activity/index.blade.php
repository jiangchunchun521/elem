@extends("layouts.admin.default")
@section("title","活动列表")
@section("content")
    <a href="{{route("activities.add")}}" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> 添加</a>
    <a href="{{route("activities.index")}}" class="btn btn-default">全部</a>
    <a href="{{route("activities.unStart")}}" class="btn btn-default">未开始</a>
    <a href="{{route("activities.going")}}" class="btn btn-default">进行中</a>
    <a href="{{route("activities.over")}}" class="btn btn-default">已结束</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动详情</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activitys as $activity)
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->title}}</td>
                <td>{!!$activity->content!!}</td>
                <td>{{$activity->start_time}}</td>
                <td>{{$activity->end_time}}</td>
                <td>
                    <a href="{{route("activities.edit",$activity)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{route("activities.del",$activity)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$activitys->links()}}
@endsection
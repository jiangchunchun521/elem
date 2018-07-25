@extends("layouts.shop.default")
@section("title","活动列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">活动信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>活动名称</th>
                            <th>活动开始时间</th>
                            <th>活动结束时间</th>
                            <th>查看</th>
                        </tr>
                        @foreach($activitys as $activity)
                            <tr>
                                <td>{{$activity->id}}</td>
                                <td>{{$activity->title}}</td>
                                <td>{{$activity->start_time}}</td>
                                <td>{{$activity->end_time}}</td>
                                <td>
                                    <a href="{{route("activity.show",$activity)}}" class="btn btn-success">活动详情...</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$activitys->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
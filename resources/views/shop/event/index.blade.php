@extends("layouts.shop.default")
@section("title","抽奖活动列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">抽奖活动信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>活动名称</th>
                            <th>报名开始时间</th>
                            <th>报名结束时间</th>
                            <th>开奖时间</th>
                            <th>报名人数</th>
                            <th>是否已开奖</th>
                            <th>查看</th>
                        </tr>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td>{{$event->title}}</td>
                                <td>{{date('Y-m-d h:i:s',$event->start)}}</td>
                                <td>{{date('Y-m-d h:i:s',$event->end)}}</td>
                                <td>{{date('Y-m-d h:i:s',$event->prize_date)}}</td>
                                <td>{{$event->num}}</td>
                                <td>
                                    @if($event->is_prize==1&&date('Y-m-d h:i:s',$event->prize_date)==date('Y-m-d h:i:s',time()))
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route("event.show",$event)}}" class="btn btn-success">活动详情...</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$events->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
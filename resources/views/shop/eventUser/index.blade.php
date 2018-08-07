@extends("layouts.shop.default")
@section("title","报名抽奖活动列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">报名抽奖活动信息</h3>
                    <div class="box-tools">
                        <a href="{{route('eventUser.add')}}" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-send"> 报名</i>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>活动名称</th>
                            <th>报名商户</th>
                        </tr>
                        @foreach($events as $event)
                            <tr>
                                <td>{{$event->id}}</td>
                                <td>{{$event->event->title}}</td>
                                <td>{{$event->user->name}}</td>
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
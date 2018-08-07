@extends("layouts.shop.default")
@section("title","抽奖结果列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">抽奖结果信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>活动名称</th>
                            <th>奖品名称</th>
                            <th>中奖商户</th>
                            <th>查看</th>
                        </tr>
                        @foreach($prizes as $prize)
                            @if(date('Y-m-d h:i:s',$prize->event->prize_date) < date('Y-m-d h:i:s',time()))
                                <tr>
                                    <td>{{$prize->id}}</td>
                                    <td>{{$prize->event->title}}</td>
                                    <td>{{$prize->name}}</td>
                                    <td>{{$prize->user_id}}</td>
                                    <td>
                                        <a href="{{route("prize.show",$prize)}}" class="btn btn-success">奖品详情...</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {{$prizes->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
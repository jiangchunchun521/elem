@extends("layouts.shop.default")
@section("title","订单列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">订单信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>订单编号</th>
                            <th>手机号</th>
                            <th>总价格</th>
                            <th>操作</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->member->username}}</td>
                                <td>{{$order->sn}}</td>
                                <td>{{$order->tel}}</td>
                                <td>{{$order->total}}</td>
                                <td>
                                    <a href="{{route("order.show",$order)}}" class="btn btn-info">订单详情</a>
                                    @if($order->status==0)
                                        <a href="#" class="btn btn-success">代付款</a>
                                    @elseif($order->status==1)
                                        <a href="{{route("order.send",$order)}}" class="btn btn-success">待发货</a>
                                    @elseif($order->status==2)
                                        <a href="#" class="btn btn-success">待确认</a>
                                    @endif
                                    @if($order->status==-1)
                                        <a href="#" class="btn btn-danger">已取消</a>
                                    @elseif($order->status==1)
                                        <a href="{{route("order.cancel",$order)}}" class="btn btn-danger">取消订单</a>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$orders->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
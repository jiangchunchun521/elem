@extends("layouts.shop.default")
@section("title","查看订单")
@section("content")
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">订单详情</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2">用户名：</label>
                    <div class="col-sm-10">
                        <td>{{$order->member->username}}</td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">订单编号：</label>
                    <div class="col-sm-10">
                        <td>{{$order->sn}}</td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">收货地址：</label>
                    <div class="col-sm-10">
                        <td>{{$order->provence}} {{$order->city}} {{$order->area}} {{$order->detail_address}}</td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">收货人姓名：</label>
                    <div class="col-sm-10">
                        <td>{{$order->name}}</td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">收货人电话：</label>
                    <div class="col-sm-10">
                        <td>{{$order->tel}}</td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">总价格：</label>
                    <div class="col-sm-10">
                        <td>{{$order->total}}</td>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">状态：</label>
                    <div class="col-sm-10">
                        @if($order->status==-1)
                            <td>已取消</td>
                        @elseif($order->status==0)
                            <td>代付款</td>
                        @elseif($order->status==1)
                            <td>待发货</td>
                        @elseif($order->status==2)
                            <td>待确认</td>
                        @elseif($order->status==3)
                            <td>完成</td>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </form>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>菜品名称</th>
                    <th>数量</th>
                    <th>菜品图片</th>
                    <th>菜品价格</th>
                </tr>
                @foreach($goods as $good)
                    <tr>
                        <td>{{$good->goods_name}}</td>
                        <td>{{$good->amount}}</td>
                        <td>
                            @if($good->goods_img)
                                <img src="/{{$good->goods_img}}" width="50" class="img-circle">
                            @endif
                        </td>
                        <td>{{$good->goods_price}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
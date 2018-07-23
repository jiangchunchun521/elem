@extends("layouts.shop.default")
@section("title","商户列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">注册信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>商户姓名</th>
                            <th>Email</th>
                            <th>所属商家</th>
                            <th>状态</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->shop->shop_name}}</td>
                                <td>
                                    @if($user->status==1)
                                        <i class="glyphicon glyphicon-ok-sign" style="color: blue"></i>
                                    @elseif($user->status==0)
                                        <i class="glyphicon glyphicon-question-sign" style="color: red">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">店铺信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>店铺类型</th>
                            <th>店铺名称</th>
                            <th>LOGO</th>
                            <th>评分</th>
                            <th>品牌</th>
                            <th>准时送达</th>
                            <th>蜂鸟配送</th>
                            <th>保标记</th>
                            <th>票标记</th>
                            <th>准标记</th>
                            <th>起送金额</th>
                            <th>配送费</th>
                            <th>店公告</th>
                            <th>优惠信息</th>
                            <th>操作</th>
                        </tr>
                        @foreach($shops as $shop)
                            <tr>
                                <td>{{$shop->id}}</td>
                                <td>{{$shop->cate->name}}</td>
                                <td>{{$shop->shop_name}}</td>
                                <td>
                                    @if($shop->shop_img)
                                        <img src="/{{$shop->shop_img}}" width="50" class="img-circle">
                                    @endif
                                </td>
                                <td>{{$shop->shop_rating}}</td>
                                <td>
                                    @if($shop->brand==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($shop->on_time==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($shop->fengniao==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($shop->bao==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($shop->piao==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($shop->zhun==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>{{$shop->start_send}}</td>
                                <td>{{$shop->send_cost}}</td>
                                <td>{{$shop->notice}}</td>
                                <td>{{$shop->discount}}</td>
                                <td>
                                    @if($shop->status==1)
                                        <i class="glyphicon glyphicon-ok-sign" style="color: blue"></i>
                                    @elseif($shop->status==0)
                                        <i class="glyphicon glyphicon-question-sign" style="color: red"></i>
                                    @elseif($shop->status==-1)
                                        <i class="glyphicon glyphicon-ban-circle" style="color: grey"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$shops->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
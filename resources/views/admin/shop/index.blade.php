@extends("layouts.admin.default")
@section("title","商家信息列表")
@section("content")
    <a href="{{route("shop.add")}}" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> 添加商家</a>
    <table class="table table-bordered">
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
                        <a href="#" onclick="return false" class="btn btn-info"><i
                                    class="glyphicon glyphicon-ok-sign"></i></a>
                    @elseif($shop->status==0)
                        <a href="{{route("shop.check",$shop)}}" class="btn btn-info"><i
                                    class="glyphicon glyphicon-question-sign"></i></a>
                    @elseif($shop->status==-1)
                        <a href="#" onclick="return false" class="btn btn-danger"><i
                                    class="glyphicon glyphicon-ban-circle"></i></a>
                    @endif
                    <a href="{{route("shop.edit",$shop)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{route("shop.del",$shop)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$shops->appends($query)->links()}}
@endsection
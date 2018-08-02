@extends("layouts.admin.default")
@section("title","订单统计列表")
@section("content")
    <a href="{{route("orders.day")}}" class="btn btn-primary">每日统计</a>
    <a href="{{route("orders.month")}}" class="btn btn-primary">每月统计</a>
    <form action="" class="form-inline" method="get" style="float: right">
        <select name="shop_id" class="form-control">
            <option value="">请选择店铺</option>
            @foreach($shops as $shop)
                <option value="{{$shop->id}}"
                        @if($shop->id==request()->input('shop_id')) selected @endif >{{$shop->shop_name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
        </button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>订单数量</th>
            <th>总金额</th>
        </tr>
        <tr>
            <td>{{$order->count}}</td>
            <td>{{$order->money}}</td>
        </tr>
    </table>
@endsection
@extends("layouts.admin.default")
@section("title","菜品销量统计列表")
@section("content")
    <a href="{{route("orders.menuDay")}}" class="btn btn-primary">每日销量统计</a>
    <a href="{{route("orders.menuMonth")}}" class="btn btn-primary">每月销量统计</a>
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
            <th>菜品名称</th>
            <th>菜品数量</th>
        </tr>
        @foreach($goods as $good)
            <tr>
                <td>{{$good->goods_name}}</td>
                <td>{{$good->count}}</td>
            </tr>
        @endforeach
    </table>
@endsection
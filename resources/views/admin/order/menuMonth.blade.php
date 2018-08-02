@extends("layouts.admin.default")
@section("title","每月统计列表")
@section("content")
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
            <th>销售日期</th>
            <th>销售数量</th>
        </tr>
        @foreach($months as $month)
            <tr>
                <td>{{$month->goods_name}}</td>
                <td>{{$month->month}}</td>
                <td>{{$month->count}}</td>
            </tr>
        @endforeach
    </table>
@endsection
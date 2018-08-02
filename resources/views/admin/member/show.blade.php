@extends("layouts.admin.default")
@section("title","查看会员详情")
@section("content")
    <a href="{{route("member.index")}}" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> 会员列表</a>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-sm-2">会员名称：</label>
            <div class="col-sm-10">
                <td>{{$member->username}}</td>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">手机号：</label>
            <div class="col-sm-10">
                <td>{{$member->tel}}</td>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">余额：</label>
            <div class="col-sm-10">
                <td>{{$member->money}}</td>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">积分：</label>
            <div class="col-sm-10">
                <td>{{$member->jifen}}</td>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">创建时间：</label>
            <div class="col-sm-10">
                <td>{{$member->created_at}}</td>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>菜品名称</th>
                <th>购买数量</th>
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
            {{$goods->links()}}
        </table>
    </form>
@endsection
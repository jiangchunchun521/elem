@extends("layouts.admin.default")
@section("title","店铺分类列表")
@section("content")
    <a href="{{route("shop_category.add")}}" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> 添加</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商家类型名称</th>
            <th>LOGO</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>
                    @if($cate->logo)
                        <img src="/{{$cate->logo}}" width="50" class="img-circle">
                    @endif
                </td>
                <td>
                    @if($cate->status==1)
                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif
                </td>
                <td>
                    <a href="{{route("shop_category.edit",$cate)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{route("shop_category.del",$cate)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$cates->links()}}
@endsection
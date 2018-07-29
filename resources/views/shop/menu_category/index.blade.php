@extends("layouts.shop.default")
@section("title","菜品分类列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">菜品分类信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>菜品类型名称</th>
                            <th>菜品编号</th>
                            <th>所属商家</th>
                            <th>描述</th>
                            <th>默认菜品分类</th>
                            <th>操作</th>
                        </tr>
                        @foreach($cates as $cate)
                            <tr>
                                <td>{{$cate->id}}</td>
                                <td>{{$cate->name}}</td>
                                <td>{{$cate->type_accumulation}}</td>
                                <td>{{$shop['shop_name']}}</td>
                                <td>{{$cate->description}}</td>
                                <td>
                                    @if($cate->is_selected==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route("menu_category.edit",$cate)}}" class="btn btn-success"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{route("menu_category.del",$cate)}}" class="btn btn-danger"><i
                                                class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$cates->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
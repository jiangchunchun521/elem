@extends("layouts.shop.default")
@section("title","菜品列表")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">菜品信息</h3>
                    <div class="box-tools">
                        <form action="" class="form-inline" method="get">
                            <select name="category_id" class="form-control">
                                <option value="">请选择菜品分类</option>
                                @foreach($cates as $cate)
                                    <option value="{{$cate->id}}"
                                            @if($cate->id==request()->input('category_id')) selected @endif >{{$cate->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="minPrice" class="form-control" size="2" placeholder="最低价"
                                   value="{{request()->input('minPrice')}}"> -
                            <input type="text" name="maxPrice" class="form-control" size="2" placeholder="最高价"
                                   value="{{request()->input('maxPrice')}}">
                            <input type="text" name="keyword" class="form-control" placeholder="请输入菜品名称"
                                   value="{{request()->input('keyword')}}">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>评分</th>
                            <th>所属商家</th>
                            <th>所属分类</th>
                            <th>价格</th>
                            <th>月销量</th>
                            <th>评分数量</th>
                            <th>提示信息</th>
                            <th>满意度数量</th>
                            <th>满意度评分</th>
                            <th>菜品图片</th>
                            <th>是否上架</th>
                            <th>操作</th>
                        </tr>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->goods_name}}</td>
                                <td>{{$menu->rating}}</td>
                                <td>{{$shop['shop_name']}}</td>
                                <td>{{$menu->mCate->name}}</td>
                                <td>{{$menu->goods_price}}</td>
                                <td>{{$menu->month_sales}}</td>
                                <td>{{$menu->rating_count}}</td>
                                <td>{{$menu->tips}}</td>
                                <td>{{$menu->satisfy_count}}</td>
                                <td>{{$menu->satisfy_rate}}</td>
                                <td>
                                    @if($menu->goods_img)
                                        <img src="/{{$menu->goods_img}}" width="50" class="img-circle">
                                    @endif
                                </td>
                                <td>
                                    @if($menu->status==1)
                                        <i class="glyphicon glyphicon-ok" style="color: chartreuse"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route("menu.edit",$menu)}}" class="btn btn-success"><i
                                                class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{route("menu.del",$menu)}}" class="btn btn-danger"><i
                                                class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$menus->links()}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
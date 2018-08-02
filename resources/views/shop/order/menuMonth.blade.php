@extends("layouts.shop.default")
@section("title","每月菜品销量统计")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">每月菜品销量统计</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection
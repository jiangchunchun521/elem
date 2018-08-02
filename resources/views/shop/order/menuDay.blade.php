@extends("layouts.shop.default")
@section("title","每日菜品销量统计")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">每日菜品销量统计</h3>
                    <div class="box-tools">
                        <form action="" class="form-inline">
                            <input type="date" name="start" class="form-control" size="2" placeholder="开始日期"
                                   value="{{request()->input('start')}}"> -
                            <input type="date" name="end" class="form-control" size="2" placeholder="结束日期"
                                   value="{{request()->input('end')}}">
                            <input type="submit" value="搜索" class="btn btn-success">
                        </form>
                    </div>
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
                        @foreach($days as $day)
                            <tr>
                                <td>{{$day->goods_name}}</td>
                                <td>{{$day->day}}</td>
                                <td>{{$day->count}}</td>
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
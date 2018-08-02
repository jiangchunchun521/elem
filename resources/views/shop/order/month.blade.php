@extends("layouts.shop.default")
@section("title","每月累计")
@section("content")
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">每月累计</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>订单日期</th>
                            <th>订单数量</th>
                            <th>总金额</th>
                        </tr>
                        @foreach($months as $month)
                            <tr>
                                <td>{{$month->month}}</td>
                                <td>{{$month->count}}</td>
                                <td>{{$month->money}}</td>
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
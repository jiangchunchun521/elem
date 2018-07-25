@extends("layouts.shop.default")
@section("title","添加菜品")
@section("content")
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">添加菜品</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="goods_name" class="col-sm-2 control-label">名称</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('goods_name')}}" class="form-control" placeholder="请输入菜品名称"
                               name="goods_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="rating" class="col-sm-2 control-label">评分</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('rating')}}" class="form-control" name="rating">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category_id" class="col-sm-2 control-label">菜品类型</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="category_id">
                            <option value="0">请选择菜品类型</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="goods_price" class="col-sm-2 control-label">价格</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('goods_price')}}" class="form-control" placeholder="请输入价格"
                               name="goods_price">
                    </div>
                </div>
                <div class="form-group">
                    <label for="month_sales" class="col-sm-2 control-label">月销量</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('month_sales')}}" class="form-control" name="month_sales">
                    </div>
                </div>
                <div class="form-group">
                    <label for="rating_count" class="col-sm-2 control-label">评分数量</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('rating_count')}}" class="form-control" name="rating_count">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tips" class="col-sm-2 control-label">提示信息</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('tips')}}" class="form-control" name="tips">
                    </div>
                </div>
                <div class="form-group">
                    <label for="satisfy_count" class="col-sm-2 control-label">满意度数量</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('satisfy_count')}}" class="form-control" name="satisfy_count">
                    </div>
                </div>
                <div class="form-group">
                    <label for="satisfy_rate" class="col-sm-2 control-label">满意度评分</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('satisfy_rate')}}" class="form-control" name="satisfy_rate">
                    </div>
                </div>
                <div class="form-group">
                    <label for="goods_img" class="col-sm-2 control-label">菜品图片</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="goods_img">
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-2 control-label">是否上架</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="0">否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="captcha" class="col-sm-2 control-label">验证码</label>
                    <div class="col-sm-1">
                        <input id="captcha" class="form-control" name="captcha">
                    </div>
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}"
                         onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">提交</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection
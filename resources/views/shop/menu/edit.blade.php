@extends("layouts.shop.default")
@section("title","编辑菜品")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="goods_name" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('goods_name',$menu->goods_name)}}" class="form-control"
                       name="goods_name">
            </div>
        </div>
        <div class="form-group">
            <label for="rating" class="col-sm-2 control-label">评分</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('rating',$menu->rating)}}" class="form-control" name="rating">
            </div>
        </div>
        <div class="form-group">
            <label for="category_id" class="col-sm-2 control-label">菜品类型</label>
            <div class="col-sm-10">
                <select class="form-control" name="category_id">
                    <option value="0">请选择菜品类型</option>
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}"
                                @if($cate->id==$menu->category_id) selected @endif>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="goods_price" class="col-sm-2 control-label">价格</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('goods_price',$menu->goods_price)}}" class="form-control"
                       name="goods_price">
            </div>
        </div>
        <div class="form-group">
            <label for="month_sales" class="col-sm-2 control-label">月销量</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('month_sales',$menu->month_sales)}}" class="form-control"
                       name="month_sales">
            </div>
        </div>
        <div class="form-group">
            <label for="rating_count" class="col-sm-2 control-label">评分数量</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('rating_count',$menu->rating_count)}}" class="form-control"
                       name="rating_count">
            </div>
        </div>
        <div class="form-group">
            <label for="tips" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('tips',$menu->tips)}}" class="form-control" name="tips">
            </div>
        </div>
        <div class="form-group">
            <label for="satisfy_count" class="col-sm-2 control-label">满意度数量</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('satisfy_count',$menu->satisfy_count)}}" class="form-control"
                       name="satisfy_count">
            </div>
        </div>
        <div class="form-group">
            <label for="satisfy_rate" class="col-sm-2 control-label">满意度评分</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('satisfy_rate',$menu->satisfy_rate)}}" class="form-control"
                       name="satisfy_rate">
            </div>
        </div>
        <div class="form-group">
            <label for="goods_img" class="col-sm-2 control-label">菜品图片</label>
            <div class="col-sm-10">
                @if($menu->goods_img)
                    <img src="/{{$menu->goods_img}}" width="50" class="img-circle">
                @endif
                <input type="file" class="form-control" name="goods_img">
            </div>
        </div>
        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="status" value="1" {{$menu->status==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" value="0" {{$menu->status==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
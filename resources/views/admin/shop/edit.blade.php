@extends("layouts.admin.default")
@section("title","编辑商家信息")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="shop_cate_id" class="col-sm-2 control-label">店铺类型</label>
            <div class="col-sm-4">
                <select class="form-control" name="shop_cate_id">
                    <option value="0">请选择店铺类型</option>
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}"
                                @if($cate->id==$shop->shop_cate_id) selected @endif>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="shop_name" class="col-sm-1 control-label">店铺名称</label>
            <div class="col-sm-4">
                <input type="text" value="{{old('shop_name',$shop->shop_name)}}" class="form-control" name="shop_name"
                       id="shop_name">
            </div>
        </div>
        <div class="form-group">
            <label for="shop_rating" class="col-sm-2 control-label">评分</label>
            <div class="col-sm-4">
                <input type="text" value="{{old('shop_rating',$shop->shop_rating)}}" class="form-control"
                       name="shop_rating" id="shop_rating">
            </div>
            <label for="shop_img" class="col-sm-1 control-label">店铺图片</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" name="shop_img" id="shop_img">
                @if($shop->shop_img)
                    <img src="/{{$shop->shop_img}}" width="50" class="img-circle">
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="brand" class="col-sm-2 control-label">品牌</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="brand" value="1" {{$shop->brand==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="brand" value="0" {{$shop->brand==0?"checked":""}}>否
                </label>
            </div>
            <label for="on_time" class="col-sm-1 control-label">准时送达</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="on_time" value="1" {{$shop->on_time==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" value="0" {{$shop->on_time==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="fengniao" class="col-sm-2 control-label">蜂鸟配送</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="fengniao" value="1" {{$shop->fengniao==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" value="0" {{$shop->fengniao==0?"checked":""}}>否
                </label>
            </div>
            <label for="bao" class="col-sm-1 control-label">保标记</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="bao" value="1" {{$shop->bao==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="bao" value="0" {{$shop->bao==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="piao" class="col-sm-2 control-label">票标记</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="piao" value="1" {{$shop->piao==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="piao" value="0" {{$shop->piao==0?"checked":""}}>否
                </label>
            </div>
            <label for="zhun" class="col-sm-1 control-label">准标记</label>
            <div class="col-sm-4">
                <label class="radio-inline">
                    <input type="radio" name="zhun" value="1" {{$shop->zhun==1?"checked":""}}>是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="zhun" value="0" {{$shop->zhun==0?"checked":""}}>否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="start_send" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-4">
                <input type="text" value="{{old('start_send',$shop->start_send)}}" class="form-control"
                       name="start_send" id="start_send">
            </div>
            <label for="send_cost" class="col-sm-1 control-label">配送费</label>
            <div class="col-sm-4">
                <input type="text" value="{{old('send_cost',$shop->send_cost)}}" class="form-control" name="send_cost"
                       id="send_cost">
            </div>
        </div>
        <div class="form-group">
            <label for="notice" class="col-sm-2 control-label">店广告</label>
            <div class="col-sm-4">
                <input type="text" value="{{old('notice',$shop->notice)}}" class="form-control" name="notice"
                       id="notice">
            </div>
            <label for="discount" class="col-sm-1 control-label">优惠信息</label>
            <div class="col-sm-4">
                <input type="text" value="{{old('discount',$shop->discount)}}" class="form-control" name="discount"
                       id="discount">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
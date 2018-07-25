@extends("layouts.shop.default")
@section("title","商户注册")
@section("content")
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">商户注册</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="shop_cate_id" class="col-sm-2 control-label">店铺类型</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="shop_cate_id">
                            <option value="0">请选择店铺类型</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="shop_name" class="col-sm-1 control-label">店铺名称</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('shop_name')}}" class="form-control" name="shop_name" id="shop_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="shop_rating" class="col-sm-2 control-label">评分</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('shop_rating')}}" class="form-control" name="shop_rating" id="shop_rating">
                    </div>
                    <label for="shop_img" class="col-sm-1 control-label">店铺图片</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="shop_img" id="shop_img">
                    </div>
                </div>
                <div class="form-group">
                    <label for="brand" class="col-sm-2 control-label">品牌</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="brand" id="inlineRadio1" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="brand" id="inlineRadio2" value="0">否
                        </label>
                    </div>
                    <label for="on_time" class="col-sm-1 control-label">准时送达</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="on_time" id="inlineRadio1" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="on_time" id="inlineRadio2" value="0">否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fengniao" class="col-sm-2 control-label">蜂鸟配送</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="fengniao" id="inlineRadio1" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="fengniao" id="inlineRadio2" value="0">否
                        </label>
                    </div>
                    <label for="bao" class="col-sm-1 control-label">保标记</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="bao" id="inlineRadio1" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="bao" id="inlineRadio2" value="0">否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="piao" class="col-sm-2 control-label">票标记</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="piao" id="inlineRadio1" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="piao" id="inlineRadio2" value="0">否
                        </label>
                    </div>
                    <label for="zhun" class="col-sm-1 control-label">准标记</label>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" name="zhun" id="inlineRadio1" value="1" checked>是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="zhun" id="inlineRadio2" value="0">否
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_send" class="col-sm-2 control-label">起送金额</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('start_send')}}" class="form-control" name="start_send" id="start_send">
                    </div>
                    <label for="send_cost" class="col-sm-1 control-label">配送费</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('send_cost')}}" class="form-control" name="send_cost" id="send_cost">
                    </div>
                </div>
                <div class="form-group">
                    <label for="notice" class="col-sm-2 control-label">店广告</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('notice')}}" class="form-control" name="notice" id="notice">
                    </div>
                    <label for="discount" class="col-sm-1 control-label">优惠信息</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('discount')}}" class="form-control" name="discount" id="discount">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">商户姓名</label>
                    <div class="col-sm-4">
                        <input type="text" value="{{old('name')}}" class="form-control" id="name" placeholder="请输入用户名"
                               name="name">
                    </div>
                    <label for="email" class="col-sm-1 control-label">Email</label>
                    <div class="col-sm-4">
                        <input type="email" value="{{old('email')}}" class="form-control" name="email" placeholder="请输入Email地址">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-4">
                        <input type="password" value="{{old('password')}}" class="form-control" id="password" placeholder="请输入密码"
                               name="password">
                    </div>
                    <label for="password_confirmation" class="col-sm-1 control-label">确认密码</label>
                    <div class="col-sm-4">
                        <input type="password" value="{{old('password_confirmation')}}" class="form-control" id="password" placeholder="请输入确认密码"
                               name="password_confirmation">
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
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">提交</button>
        </div>
    </div>

@endsection
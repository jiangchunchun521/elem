@extends("layouts.shop.default")
@section("title","添加菜品分类")
@section("content")
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">添加菜品分类</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">菜品类型名称</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('name')}}" class="form-control" placeholder="请输入菜品类型名称"
                               name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type_accumulation" class="col-sm-2 control-label">菜品编号</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('type_accumulation')}}" class="form-control" placeholder="请输入菜品编号"
                               name="type_accumulation">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">描述</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{old('description')}}" class="form-control" placeholder="请输入描述"
                               name="description">
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_selected" class="col-sm-2 control-label">默认菜品分类</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" name="is_selected" id="inlineRadio1" value="1">是
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="is_selected" id="inlineRadio2" value="0"  checked>否
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
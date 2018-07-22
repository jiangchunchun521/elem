@extends("layouts.admin.default")
@section("title","编辑店铺分类")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">店铺类型名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name',$cate->name)}}" class="form-control" id="name"
                       placeholder="请输入店铺类型名称"
                       name="name">
            </div>
            s
        </div>
        <div class="form-group">
            <label for="logo" class="col-sm-2 control-label">店铺图片</label>
            <div class="col-sm-10">
                @if($cate->logo)
                    <img src="/{{$cate->logo}}" width="50" class="img-circle">
                @endif
                <input type="file" class="form-control" name="logo" id="logo">
            </div>
        </div>
        <div class="form-group">
            <label for="status" class="col-sm-2 control-label">状态</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio1" value="1" {{$cate->status===1?"checked":""}}>显示
                </label>
                <label class="radio-inline">
                    <input type="radio" name="status" id="inlineRadio2" value="0" {{$cate->status===0?"checked":""}}>隐藏
                </label></div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
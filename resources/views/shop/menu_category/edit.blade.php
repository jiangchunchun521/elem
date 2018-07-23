@extends("layouts.shop.default")
@section("title","编辑菜品分类")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">菜品类型名称</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name',$cate->name)}}" class="form-control" placeholder="请输入菜品类型名称"
                       name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="type_accumulation" class="col-sm-2 control-label">菜品编号</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('type_accumulation',$cate->type_accumulation)}}" class="form-control" placeholder="请输入菜品编号"
                       name="type_accumulation">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('description',$cate->description)}}" class="form-control" placeholder="请输入描述"
                       name="description">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
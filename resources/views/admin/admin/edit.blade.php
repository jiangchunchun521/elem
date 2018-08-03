@extends("layouts.admin.default")
@section("title","编辑管理员")
@section("content")
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">管理员姓名</label>
            <div class="col-sm-10">
                <input type="text" value="{{old('name',$admin->name)}}" class="form-control" id="name"
                       placeholder="请输入管理员姓名"
                       name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" value="{{old('email',$admin->email)}}" class="form-control" name="email"
                       placeholder="请输入Email地址">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-10">
                @foreach($roles as $role)
                    <input type="checkbox" name="role[]" value="{{$role->name}}"
                           @if($admin->hasRole($role->name)) checked @endif>{{$role->name}}
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
            </div>
        </div>
    </form>
@endsection
@extends("layouts.admin.default")
@section("title","角色列表")
@section("content")
    <a href="{{route("role.add")}}" class="btn btn-info"><i
                class="glyphicon glyphicon-send"></i> 添加角色</a>
    <table class="table table-bordered">
        <tr>
            <th>角色ID</th>
            <th>角色名称</th>
            <th>权限名称</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{str_replace(',',' | ',str_replace(['[',']','"'],'',
                    $role->permissions()->pluck('name')))}}</td>
                <td>
                    <a href="{{route("role.edit",$role)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{route("role.del",$role)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$roles->links()}}
@endsection
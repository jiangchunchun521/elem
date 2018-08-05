@extends("layouts.admin.default")
@section("title","管理员列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>管理员姓名</th>
            <th>Email</th>
            <th>角色名称</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{str_replace(',',' | ',str_replace(['[',']','"'],'',
                    json_encode($admin->getRoleNames(),JSON_UNESCAPED_UNICODE)))}}</td>
                <td>
                    <a href="{{route("admin.edit",$admin)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    @if($admin->id!=1)
                        <a href="{{route("admin.del",$admin)}}" class="btn btn-danger"><i
                                    class="glyphicon glyphicon-trash"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{$admins->links()}}
@endsection
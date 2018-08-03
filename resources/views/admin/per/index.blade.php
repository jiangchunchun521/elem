@extends("layouts.admin.default")
@section("title","权限列表")
@section("content")
    <a href="{{route("per.add")}}" class="btn btn-info"><i
                class="glyphicon glyphicon-send"></i> 添加权限</a>
    <table class="table table-bordered">
        <tr>
            <th>权限ID</th>
            <th>权限名称</th>
            <th>权限管理平台</th>
            <th>操作</th>
        </tr>
        @foreach($pers as $per)
            <tr>
                <td>{{$per->id}}</td>
                <td>{{$per->name}}</td>
                <td>{{$per->guard_name}}</td>
                <td>
                    <a href="{{route("per.del",$per)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$pers->links()}}
@endsection
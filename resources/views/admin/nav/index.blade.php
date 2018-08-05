@extends("layouts.admin.default")
@section("title","导航菜单列表")
@section("content")
    <a href="{{route("nav.add")}}" class="btn btn-info"><i
                class="glyphicon glyphicon-send"></i> 添加导航菜单</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>导航菜单名称</th>
            <th>导航菜单地址</th>
            <th>上级菜单ID</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{$nav->id}}</td>
                <td>{{$nav->name}}</td>
                <td>{{$nav->url}}</td>
                <td>{{$nav->parent_id}}</td>
                <td>{{$nav->sort}}</td>
                <td>
                    <a href="{{route("nav.edit",$nav)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{route("nav.del",$nav)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$navs->links()}}
@endsection
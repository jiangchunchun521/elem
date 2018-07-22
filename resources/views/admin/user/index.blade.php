@extends("layouts.admin.default")
@section("title","商户注册列表")
@section("content")
   <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商户姓名</th>
            <th>Email</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->shop->shop_name}}</td>
                <td>
                    @if($user->status==1)
                        <a href="#" onclick="return false" class="btn btn-info"><i
                                    class="glyphicon glyphicon-ok-sign"></i></a>
                    @elseif($user->status==0)
                        <a href="{{route("shop.check",$user)}}" class="btn btn-info"><i
                                    class="glyphicon glyphicon-question-sign"></i></a>
                    @endif
                    <a href="{{route("users.edit",$user)}}" class="btn btn-success"><i
                                class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{route("users.del",$user)}}" class="btn btn-danger"><i
                                class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->links()}}
@endsection
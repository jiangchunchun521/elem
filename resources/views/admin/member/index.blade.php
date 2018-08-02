@extends("layouts.admin.default")
@section("title","会员列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>会员名称</th>
            <th>手机号</th>
            <th>余额</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>{{$member->tel}}</td>
                <td>{{$member->money}}</td>
                <td>
                    <a href="{{route("member.show",$member)}}" class="btn btn-info">会员详情</a>
                    <a href="{{route("member.money",$member)}}" class="btn btn-success">充值</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$members->links()}}
@endsection
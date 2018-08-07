@extends("layouts.admin.default")
@section("title","活动奖品列表")
@section("content")
    <a href="{{route("prizes.add")}}" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> 添加</a>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商户</th>
            <th>操作</th>
        </tr>
        @foreach($prizes as $prize)
            <tr>
                <td>{{$prize->id}}</td>
                <td>{{$prize->event->title}}</td>
                <td>{{$prize->name}}</td>
                <td>{!!$prize->description!!}</td>
                <td>
                    @if($prize->user_id!=null)
                        @if($prize->user_id==$user->id)
                            {{$user->name}}
                        @endif
                    @endif
                </td>
                <td>
                    @if(date('Y-m-d h:i:s',$prize->event->prize_date) > date('Y-m-d h:i:s',time()))
                        <a href="{{route("prizes.edit",$prize)}}" class="btn btn-success"><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        <a href="{{route("prizes.del",$prize)}}" class="btn btn-danger"><i
                                    class="glyphicon glyphicon-trash"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{$prizes->links()}}
@endsection
@extends("layouts.admin.default")
@section("title","抽奖活动报名列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>报名商户</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->event->title}}</td>
                <td>{{$event->user->name}}</td>
            </tr>
        @endforeach
    </table>
    {{$events->links()}}
@endsection
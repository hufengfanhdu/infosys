@extends('layouts.app')

@section('title','用户列表')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">姓名</th>
            <th scope="col">邮箱</th>
            <th scope="col">更新时间</th>
            <th scope="col">在线聊骚</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->updated_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('users.chat',compact('user')) }}" class="btn btn-light">聊天</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection

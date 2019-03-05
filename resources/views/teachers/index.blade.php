@extends('teachers.layout')

@section('title','教师中心')

@section('teacher_body')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">姓名</th>
            <th scope="col">邮箱</th>
            <th scope="col">更新时间</th>
            <th scope="col">管理操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <th scope="row">{{ $student->id }}</th>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->updated_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('users.show',compact('student')) }}" class="btn btn-light">详情</a>
                    <form action="{{ route('teachers.destroy', $student->id) }}" method="POST"
                          style="display: inline-block;"
                          onsubmit="return confirm('您确定要删除吗？');">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-light">
                            删除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $students->links() }}
@stop
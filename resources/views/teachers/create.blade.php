@extends('teachers.layout')

@section('title','添加学生')

@section('teacher_body')
    <div class="alert alert-primary" role="alert">
        请输入您要添加的学生ID以及您的密码
    </div>
    <div class="card text-left">
        <div class="card-body">
            @include('layouts._errors')
            <form method="POST" action="{{ route('teachers.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="row">
                        <label for="id" class="col-sm-1 col-form-label">学生ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="id" id="id" aria-describedby="emailHelp"
                                   placeholder="请输入对方用户ID" value="{{ old('id') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="password" class="col-form-label col-sm-1">密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="请输入您的密码">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="select" value="{{ \App\Models\Role::STUDENTS }}">
                <button type="submit" class="btn btn-primary offset-sm-10">添加</button>
            </form>
        </div>
    </div>
@stop
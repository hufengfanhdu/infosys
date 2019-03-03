@extends('layouts.app')
@section('title', '首页')

@section('content')
        <div class="card text-center">
            <div class="card-header">
                学生信息管理系统
            </div>
            <div class="card-body">
                <div class="jumbotron">
                    <h1 class="display-4">Welcome!</h1>
                    <p class="lead">欢迎使用学生信息管理系统</p>
                    <hr class="my-4">
                    <p>我们将为您提供学生信息通知管理服务</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="{{ route('users.create') }}" role="button">加入我们</a>
                    </p>
                </div>
            </div>
            <div class="card-footer text-muted">
                End
            </div>
        </div>
@stop
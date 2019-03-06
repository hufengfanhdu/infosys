@extends('layouts.app')

@section('title','邮箱认证')

@section('content')
    <div class="card text-center">
        <div class="card-header">
            邮箱认证
        </div>
        <div class="card-body">
            <h5 class="card-title">认证您的邮箱</h5>
            <p class="card-text">请打开您注册时使用的邮箱进行邮箱认证😁,若您没有收到邮件请点击重新发送验证</p>
            <form action="{{ route('validate_email',$user) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">重新发送验证</button>
            </form>
        </div>
    </div>
@stop
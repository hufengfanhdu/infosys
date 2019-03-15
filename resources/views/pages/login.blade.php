@extends('layouts.app')

@section('title','用户登录')

@section('msg_wide','w-75')

@section('content')
    <div class="card w-50 mx-auto">
        <h5 class="card-header">用户登录</h5>
        <div class="card-body px-5 py-5">
            @include('layouts._errors')
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="Email" class="col-form-label">邮箱</label>
                    <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                               placeholder="请输入邮箱" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">密码</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="check">
                        <label class="form-check-label" for="check">记住我</label>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="">忘记密码</a>
                    <a href="{{ route('login_github') }}" class="ml-1">Github登入</a>
                    <button type="submit" class="btn btn-primary ml-3">登入</button>
                </div>
            </form>
        </div>
    </div>
@stop

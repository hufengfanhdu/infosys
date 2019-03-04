@extends('layouts.app')

@section('title','用户登录')

@section('msg_wide','w-75')

@section('content')
    <div class="card w-75 mx-auto">
        <h5 class="card-header">用户登录</h5>
        <div class="card-body px-5 py-5">
            @include('layouts._errors')
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="row">
                        <label for="Email" class="col-sm-1 col-form-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="Email" aria-describedby="emailHelp"
                                   placeholder="请输入邮箱" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="password" class="col-form-label col-sm-1">密码</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="check">
                        <label class="form-check-label" for="check">记住我</label>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="offset-sm-8">忘记密码</a>
                    <button type="submit" class="btn btn-primary ml-5">登入</button>
                </div>
            </form>
        </div>
    </div>
@stop
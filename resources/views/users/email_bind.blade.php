@extends('layouts.app')

@section('title','邮箱绑定')

@section('content')
    <div class="card w-50 mx-auto">
        <h5 class="card-header">邮箱绑定</h5>
        <div class="card-body px-5 py-5">
            @include('layouts._errors')
            <form method="POST" action="{{ route('email_store') }}">
                {{ csrf_field() }}

                <div class="form-inline">
                    <label for="Email" class="col-form-label">邮箱</label>
                    <input type="email" class="ml-2 form-control col-sm-8" name="email" id="Email" aria-describedby="emailHelp"
                           placeholder="请输入邮箱" value="{{ old('email') }}">
                    <button type="submit" class="btn btn-primary ml-3">验证</button>
                </div>
            </form>
        </div>
    </div>
@endsection
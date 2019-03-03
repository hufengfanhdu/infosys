@extends('layouts.app')

@section('title','用户编辑')

@section('content')
    <div class="row">
        @include('users.show_left')
        <div class="card w-75">
            <div class="card-header bg-dark text-white font-weight-bold">
                用户编辑
            </div>
            <div class="card-body">
                @include('layouts._errors')
                <form method="POST" action="{{ route('users.update', $user->id )}}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">名称：</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="introduction">个人简介：</label>
                        <textarea name="introduction" id="introduction" rows="5" class="form-control">
                            {{ old('introduction') ? old('introduction') : $user->introduction }}
                        </textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>
@stop
@extends('layouts.app')

@section('title','用户主页')

@section('content')
    <div class="row">
        @include('users.show_left')
        <div class="card w-75">
            <div class="card-header bg-dark text-white font-weight-bold">
                个人中心
            </div>
        </div>
    </div>
@stop
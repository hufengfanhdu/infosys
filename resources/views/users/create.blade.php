@extends('layouts.app')

@section('title','注册')

@section('content')
    <div class="card">
        <h5 class="card-header">用户注册</h5>
            @include('users._form')
    </div>
@stop
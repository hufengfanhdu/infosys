@extends('layouts.app')

@section('content')
    <div class="card text-center shadow">
        <div class="card-header ">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ isActive(route('teachers.index'),14) }}"
                       href="{{ route('teachers.index') }}">学生列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isActive(route('teachers.create'),14) }}"
                       href="{{ route('teachers.create') }}">学生添加</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            @yield('teacher_body')
        </div>
    </div>
@stop
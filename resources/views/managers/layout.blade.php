@extends('layouts.app')

@section('content')
    <div class="card text-center shadow">
        <div class="card-header ">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ isActive(route('managers.index'),14) }}" href="{{ route('managers.index') }}">用户列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isActive(route('managers.role'),14) }}" href="{{ route('managers.role') }}">角色列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ isActive(route('managers.create'),14) }}" href="{{ route('managers.create') }}">教师添加</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            @yield('manager_body')
        </div>
    </div>
@stop
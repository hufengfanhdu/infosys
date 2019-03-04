@extends('managers.layout')

@section('title',"角色列表")

@section('manager_body')
    <nav class="nav nav-pills nav-justified mb-2">
        <a class="nav-item nav-link {{isActive(route('managers.role'),14)}}"
           href="{{ route('managers.role') }}">
            所有权限</a>
        <a class="nav-item nav-link {{isActive(route('managers.role')."/3",14)}}"
           href="{{ route('managers.role',['option' => \App\Models\Role::MANAGERS]) }}">
            管理员</a>
        <a class="nav-item nav-link {{isActive(route('managers.role')."/2",14)}}"
           href="{{ route('managers.role',['option' => \App\Models\Role::TEACHERS]) }}">
            教师</a>
        <a class="nav-item nav-link {{isActive(route('managers.role')."/1",14)}}"
           href="{{ route('managers.role',['option' => \App\Models\Role::STUDENTS]) }}">
            学生</a>
    </nav>
    @include('managers.roles_list')
@stop
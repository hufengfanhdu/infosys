@extends('managers.layout')

@section('title',"角色添加")

@section('manager_body')
    <div class="alert alert-primary" role="alert">
        您只能添加教师与学生角色，且同一个用户不能添加已有角色
    </div>
<div class="card text-left">
    <div class="card-body">
        @include('layouts._errors')
        <form method="POST" action="{{ route('managers.store') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="row">
                    <label for="id" class="col-sm-1 col-form-label">用户ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="id" id="id" aria-describedby="emailHelp"
                               placeholder="请输入对方用户ID" value="{{ old('id') }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="select" class="col-sm-1 col-form-label">用户权限</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="select" name="select">
                            <option value="1">学生</option>
                            <option value="2">教师</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="password" class="col-form-label col-sm-1">密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="请输入您的密码">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary offset-sm-10">添加</button>
        </form>
    </div>
</div>
@stop
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UsersRequest extends FormRequest
{
    /**
     * 用户表单注册规则
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,12|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 为必填项目',
            'email' => ':attribute 邮箱格式不正确',
            'between' => ':attribute 长度不符合规范',
            'min' => ':attribute 长度不符合规范',
            'confirmed' => ':attribute 输入不一致',
            'unique' => ':attribute 已存在'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'password' => '密码'
        ];
    }
}

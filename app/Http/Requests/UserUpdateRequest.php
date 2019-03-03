<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{

    /**
     * 用户编辑表单规则
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,12|unique:users,name,'.Auth::id(),
            'introduction' => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 为必填项目',
            'between' => ':attribute 长度不符合规范',
            'max' => ':attribute 长度超多限制',
            'unique' => ':attribute 已存在'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'introduction' => '个人简介'
        ];
    }
}

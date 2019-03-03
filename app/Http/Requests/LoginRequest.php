<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    /**
     * 用户登录请求规则
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 为必填项',
            'email' => ':attribute 格式错误',
        ];
    }

    public function attributes()
    {
        return [
          'email' => '邮箱',
          'password' => '密码'
        ];
    }
}

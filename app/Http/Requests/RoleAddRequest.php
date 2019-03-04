<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleAddRequest extends FormRequest
{


    /**
     * 角色创建请求规则
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:users,id|required|integer',
            'select' => 'required|integer|'.Rule::unique('roles','role')->where('user_id',request()->input('id')),
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'exists' => ':attribute 不存在',
            'required' => ':attribute 为必填项',
            'integer' => ':attribute 格式错误',
            'unique' => ':attribute 已经存在'
        ];
    }

    public function attributes()
    {
        return [
            'id' => '用户ID',
            'select' => '该权限',
            'password' => '密码'
        ];
    }
}

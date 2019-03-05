<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RoleAddRequest extends FormRequest
{


    /**
     * 角色创建请求规则
     * @return array
     */
    public function rules()
    {
        if (isActive(route('managers.store'),14)){
            return [
                'id' => 'exists:users,id|required|integer',
                'select' => 'required|integer|'.Rule::unique('roles','role')->where('user_id',request()->input('id')),
                'password' => 'required'
            ];
        }else {
            return [
                'id' => 'exists:users,id|required|integer|'.Rule::unique('teachers','user_id')->where('teacher_id', Auth::id()),
                'password' => 'required'
            ];
        }

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
            'id' => '该用户',
            'select' => '该权限',
            'password' => '密码'
        ];
    }
}

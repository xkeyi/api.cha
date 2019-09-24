<?php

namespace App\Http\Requests;

class UserRequest extends FormRequest
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'username' => 'required|between:5,20|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,username',
                    'password' => 'required|string|between:6,32',
                    'verification_key' => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;

            default:
                // code...
                break;
        }
    }

    public function attributes()
    {
        return [
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
            'introduction' => '个人简介',
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => '用户名已被占用，请重新填写',
            'username.regex' => '用户名只支持英文、数字、横杆和下划线。',
            'username.between' => '用户名必须介于 5 - 20 个字符之间。',
            'username.required' => '用户名不能为空。',
        ];
    }
}

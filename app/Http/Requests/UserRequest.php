<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         * 定义的规则
         * @return array
         */
        public function rules()
        {
            return [
                //required 必须输入
                'name'    => 'required',
                //必须输入|长度为6|再次确认
                'password'=> 'required|min:3|confirmed',
                //只能唯一
                'email'   => 'email|unique:users',
                'code'    => [
                    //必须输入
                    'required',
                    //value 是表单code相对应的值
                    //fail 是类似和弹出一样的提示
                    function($attribute,$value,$fail){
                        //判断如果输入的验证码和session里面的验证码不一致
                        if($value != session('code')){
                            //则验证码正确
                            $fail('验证码不正确');
                        }
                    }
                ]
            ];
        }

        //用户输出错误信息时我们自定义输出的提示
        public function messages()
        {
            return [
                'name.required'          => '朋友，你的帅气用户名呢',
                'password.required'      => '朋友，密码没填',
                'password.confirmed'     => '兄弟，两次密码不一样',
                'email.unique'           => '该邮箱已注册啦',
                'email.email'            => '要输入正确的邮箱格式噢~',
                'password.min'           => '密码要超过3位噢~',
                'code.required'          => '请输入验证码'
            ];
        }
}

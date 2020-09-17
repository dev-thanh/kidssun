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
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'     => 'required|unique:users,user_name|regex:/^[A-Za-z0-9_\.]{6,32}$/',
            'name'          => 'required',
            'phone'         => 'required|max:12|min:10|unique:users,phone',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'repassword'    => 'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            'user_name.required'    => 'Bạn chưa nhập tên tài khoản.',
            'user_name.unique'      => 'Tên tài khoản đã được sử dụng.',
            'user_name.regex'       => 'Tên tài khoản không đúng định dạng.',
            'name.required'         => 'Bạn chưa nhập họ tên.',
            'phone.required'        => 'Bạn chưa nhập số điện thoại.',
            'phone.min'             => 'Số điện thoại bạn nhập không đúng định dạng.',
            'phone.max'             => 'Số điện thoại bạn nhập không đúng định dạng.',
            'phone.unique'          => 'Số điện thoại đã tồn tại.',
            'email.unique'          => 'Email đã tồn tại.',
            'email.email'           => 'Email không đúng định dạng.',
            'email.required'        => 'Bạn chưa nhập email.',
            'password.required'     => 'Bạn chưa nhập mật khẩu.',
            'password.min'          => 'Bạn cần nhập mật khẩu nhiều hơn 6 ký tự.',
            'repassword.required'   => 'Bạn chưa nhập lại mật khẩu.',
            'repassword.same'       => 'Hai mật khẩu bạn nhập không khớp nhau.',
        ];
    }
}

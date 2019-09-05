<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginPost extends FormRequest
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
    //dinh nghia cac luat
    public function rules()
    {
        return [
            'username' => 'required|max:20',
            'password' => 'required|max:20'
        ];
    }

    //thong bao loi ra
    public function messages(){
        return [
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.max' => 'Tên đăng nhập không được dài quá :max kí tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.max' => 'Mật khẩu không được dài quá :max kí tự'
        ];
    }
}

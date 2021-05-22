<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckEmailRule;
use App\Rules\CheckPhoneRule;

class StoreEditInfoStudent extends FormRequest
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
            'student_name' => 'required|max:100',
            'birthday' => 'required',
            'email' => ['required','max:50',new CheckEmailRule()],
            'phone' => ['required','max:20','min:10',new CheckPhoneRule()],
            'gender' => 'required',
            'address' => 'required|max:100',
        ];
    }

    public function messages(){
        return [
            'student_name.required' => 'Họ và tên giáo viên không được để trống',
            'student_name.max' => 'Họ và tên giáo viên không được vượt quá số kí tự cho phép',
            'birthday.required' => 'Ngày sinh không được để trống',
            'email.required' => 'E-mail không được để trống',
            'email.max' => 'E-mail không được vượt quá số kí tự cho phép',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.max' => 'Số điện thoại không được vượt quá số kí tự cho phép',
            'phone.min' => 'Số điện thoại không được ít hơn 10 kí tự', 
            'gender.required' => 'Giới tính không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'address.max' => 'Địa chỉ không được vượt quá số kí tự cho phép',   
        ];
    }
}

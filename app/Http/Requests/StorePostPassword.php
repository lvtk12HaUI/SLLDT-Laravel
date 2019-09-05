<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPasswordRule;

class StorePostPassword extends FormRequest
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
            'pass' => 'required|min:6|max:20',
            'PassNew' => ['required','min:6','max:20',new CheckPasswordRule()],
        ];
    }

    public function messages(){
        return [
            'pass.required' => 'Không được bỏ trống',
            'pass.min' => 'Mật khẩu không được ít hơn 6 kí tự',
            'pass.max' => 'Mật khẩu không được nhiều hơn 20 kí tự',
            'PassNew.required' => 'Không được bỏ trống',
            'PassNew.min' => 'Mật khẩu không được ít hơn 6 kí tự',
            'PassNew.max' => 'Mật khẩu không được nhiều hơn 20 kí tự',
        ];
    }
}

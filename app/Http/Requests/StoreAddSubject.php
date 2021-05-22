<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddSubject extends FormRequest
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
            'subject_number' => 'required',
            'subject_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'subject_number.required' => 'Mã môn học không được để trống',
            'subject_name.required' => 'Tên môn học không được để trống',
        ];
    }

    
}

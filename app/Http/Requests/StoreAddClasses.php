<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddClasses extends FormRequest
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
            'class_name' => 'required',
            'class_id' => 'required',
            'room_id' => 'required'
        ];
    }

    public function messages(){
        return [
            'class_name.required' => 'Tên lớp học không được để trống',
            'class_id.required' => 'Khối học không được để trống',
            'room_id.required' => 'Phòng học không được để trống'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddTKBTeachers extends FormRequest
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
            'class' => 'required',
            'weekdays' => 'required',
            'tiethoc' => 'required',
        ];
    }

    public function messages(){
        return [
            'class.required' => 'Hãy chọn lớp học',
            'weekdays.required' => 'Hãy chọn thứ trong tuần',
            'tiethoc.required' => 'Hãy chọn tiết học',
        ];
    }
}

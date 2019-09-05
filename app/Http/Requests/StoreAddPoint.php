<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPointRule;

class StoreAddPoint extends FormRequest
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
            'type_of_point' => 'required',
            'point' => ['required',new CheckPointRule()]
        ];
    }

    public function messages(){
        return[
            'type_of_point.required' => 'Loại điểm không được để trống',
            'point.required' => 'Điểm không được để trống'
        ];
    }
}

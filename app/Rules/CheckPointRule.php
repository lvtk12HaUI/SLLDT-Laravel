<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPointRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(is_array($value)){
            foreach($value as $val){
                if($val['point'] !== ''){
                    return preg_match("/^(([0-9]{1}?([.][5]{1})?)|((10){1}))$/", $val['point']);
                }
                else{
                    return 1;
                }    
            }
        }
        return preg_match("/^(([0-9]{1}?([.][5]{1})?)|((10){1}))$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Điểm số không hợp lệ';
    }
}

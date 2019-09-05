<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Weekdays extends Model
{
    protected $table = 'weekdays';

    public function getAllDataWeekdays(){
        $result = [];
        $data = Weekdays::select('*')
                ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }
}

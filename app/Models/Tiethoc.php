<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tiethoc extends Model
{
    protected $table = 'tiethoc';

    public function getAllDataTietHoc(){
        $result = [];
        $data = Tiethoc::select('*')
                ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }
}

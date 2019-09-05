<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeOfPoint extends Model
{
    protected $table = 'typeofpoint';

    public function test(){
        $sum = TypeOfPoint::select('*')->sum('coefficient');
        return $sum;
    }

    public function getAllData(){
        $result = [];
        $data = TypeOfPoint::select('point_id','name')
                ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getCoefficient($point_id){
        $result = [];
        $data = TypeOfPoint::select('coefficient')
                ->where('point_id',$point_id)
                ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

}

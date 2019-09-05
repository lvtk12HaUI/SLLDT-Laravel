<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointOfStudent extends Model
{
    protected $table = 'pointofStudent';

    public function getPointByStudent($student_number){
        $result = [];
        $data = PointOfStudent::select('subject_number','point_id','point')
                            ->where('student_number',$student_number)
                            ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }
    
    public function delPoint($student_number){
        PointOfStudent::where('student_number',$student_number)
                    ->delete();
        return true;
    }
}

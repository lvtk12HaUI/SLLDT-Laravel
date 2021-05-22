<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point_AVG extends Model
{
    protected $table = 'point_avg';

    const LOAI_GIOI = 8;
    const LOAI_KHA = 6.5;
    const LOAI_TRUNG_BINH = 5;
    const LOAI_YEU = 3.5;

    public function getPointByStudent($student_number){
        $result = [];
        $data = Point_AVG::select('student_number','subject','point_avg')
                        ->where('student_number',$student_number)
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getPointAVG($student_number,$subject){
        $result = [];
        $data = Point_AVG::select('point_avg','sumCoeff')
                        ->where([
                            'student_number' => $student_number,
                            'subject' => $subject
                        ])
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function updatePointAVG($student_number,$subject,$dataUpdatePointAVG = []){
        Point_AVG::where([
            'student_number' => $student_number,
            'subject' => $subject
        ])->update([
            'point_avg' => $dataUpdatePointAVG['point_avg'],
            'sumCoeff' => $dataUpdatePointAVG['sumCoeff'],
            'updated_at' => $dataUpdatePointAVG['updated_at']
            ]);
        return true;
    }

    public function delPointAVG($student_number){
        Point_AVG::where('student_number',$student_number)
                    ->delete();
        return true;
    }

    
}

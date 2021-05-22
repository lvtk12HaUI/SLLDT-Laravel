<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tkbofteachers extends Model
{
    protected $table = 'tkbofteachers';

    public function getDataTKBOfTeacher($teacher_number){
        $result = [];
        $data = Tkbofteachers::select('Tkbofteachers.id','Tkbofteachers.teacher_number','Tkbofteachers.class','Tkbofteachers.tiethoc_id','Tkbofteachers.weekdays_id','rooms.name as room_name')
                        ->join('classes','Tkbofteachers.class','=','classes.class_name')
                        ->join('rooms','classes.room_id','=','rooms.id')
                        ->where('teacher_number',$teacher_number)
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    } 

    public function getTeachersNumber($class_name){
        $result = [];
        $data = Tkbofteachers::select('teacher_number')
                        ->where('class',$class_name)
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getDataTKBOfClass($class){
        $result = [];
        $data = Tkbofteachers::select('tkbofteachers.teacher_number','tkbofteachers.class','tkbofteachers.weekdays_id','tkbofteachers.tiethoc_id',
                                'infoteachers.teacher_name','subjects.name as sj_name')
                            ->join('infoteachers','tkbofteachers.teacher_number','=','infoteachers.teacher_number')
                            ->join('subjects','infoteachers.subject_number','=','subjects.subject_number')
                            ->where('tkbofteachers.class',$class)
                            ->get();  
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }
    
    public function CheckData($class,$wk_id,$th_id){
        $result = [];
        $data = Tkbofteachers::select('*')
                        ->where([
                            'class' => $class,
                            'weekdays_id' => $wk_id,
                            'tiethoc_id' => $th_id
                        ])
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function delTKBOfTeacher($teacher_number){
        Tkbofteachers::where('teacher_number',$teacher_number)
                    ->delete();
        return true;
    }

    public function delTKBByClass($class_name){
        Tkbofteachers::where('class',$class_name)
                    ->delete();
    }



}

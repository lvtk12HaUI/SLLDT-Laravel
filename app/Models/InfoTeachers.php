<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InfoTeachers extends Model
{
    protected $table = 'infoteachers';

    public function checkAddInfoTeachers($teacher_number){
        $result = [];
        $data = InfoTeachers::select('*')
                        ->where('teacher_number',$teacher_number)
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function checkClass($class){
        $result = [];
        $data = InfoTeachers::select('*')
                        ->where('class',$class)
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getInfoTeachersByClass($teachersNumber = []){
        $data = [];
        foreach($teachersNumber as $key => $val){
            $data[$key] = InfoTeachers::select('infoTeachers.teacher_number','infoTeachers.teacher_name','infoTeachers.gender','infoTeachers.is_gvcn','infoTeachers.class','subjects.name','phone')
                                        ->join('subjects','subjects.subject_number','=','infoTeachers.subject_number')
                                        ->where('infoTeachers.teacher_number',$val)
                                        ->first();
            $data[$key] = $data[$key]->toArray();
        }
        return $data;
    }

    public function getInfoGVCN($class_name){
        $result = [];
        $data = InfoTeachers::select('infoTeachers.teacher_number','infoTeachers.teacher_name','infoTeachers.gender','infoTeachers.is_gvcn','infoTeachers.class','subjects.name','phone')
                        ->join('subjects','subjects.subject_number','=','infoTeachers.subject_number')
                        ->where([
                            'is_gvcn' => 1,
                            'class' => $class_name,
                        ])
                     ->first();
        if($data){
            $result = $data->toArray($data);
        }
        return $result;
    }

    public function getInfoTeacher($teacher_number){
        $result = [];
        $data =  InfoTeachers::select('infoteachers.teacher_number','infoteachers.teacher_name','infoteachers.birthday','infoteachers.gender',
        'infoteachers.class','infoteachers.email','infoteachers.phone','infoteachers.address','subjects.name')
                    ->join('subjects','infoteachers.subject_number','=','subjects.subject_number')
                    ->where('teacher_number',$teacher_number) 
                    ->first();
        if($data){
            $result = $data->toArray($data);
        }
        return $result;
    }

    public function getSubject($teacher_number){
        $subject = InfoTeachers::select('infoTeachers.subject_number','subjects.name')
                            ->join('subjects','infoTeachers.subject_number','=','subjects.subject_number')
                            ->where('teacher_number',$teacher_number)
                            ->first();
        $subject = $subject->toArray();
        return $subject;
    }

    public function listInfoTeachers($keyword){
        $result = [];
        $data = InfoTeachers::select('infoteachers.teacher_number','infoteachers.teacher_name','infoteachers.birthday','infoteachers.email',
                                    'infoteachers.phone','infoteachers.gender','infoteachers.address','subjects.name')
                        ->join('subjects','infoteachers.subject_number','=','subjects.subject_number') 
                        ->where(function($query) use ($keyword){
                             $query->where('infoteachers.teacher_number','LIKE',"%{$keyword}%");
                             $query->orwhere('infoteachers.teacher_name','LIKE',"%{$keyword}%");
                             $query->orwhere('subjects.name','LIKE',"%{$keyword}%");
                         })           
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function delInfoTeachers($teacher_number){
        InfoTeachers::where('teacher_number',$teacher_number)
                    ->delete();
        return true;
    }

    public function updateInfoTeachers($teacher_number, $info = []){
        InfoTeachers::where('teacher_number',$teacher_number)
                    ->update([
                        'teacher_name' => $info['teacher_name'],
                        'birthday' => $info['birthday'],
                        'subject_number' => $info['subject_number'],
                        'is_gvcn' => $info['is_gvcn'],
                        'class' => $info['class'],
                        'email' => $info['email'],
                        'phone' => $info['phone'],
                        'gender' => $info['gender'],
                        'address' => $info['address'],
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
        return true;
    }

    public function checkTeacherNumber($teacher_number){
        $result = [];
        $data = InfoTeachers::select('*')
                        ->where('teacher_number',$teacher_number)
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function updateInfoTeachers_2($teacher_number, $info = []){
        InfoTeachers::where('teacher_number',$teacher_number)
                    ->update([
                        'teacher_number' => $info['teacher_number'],
                        'teacher_name' => $info['teacher_name'],
                        'birthday' => $info['birthday'],
                        'subject_number' => $info['subject_number'],
                        'is_gvcn' => $info['is_gvcn'],
                        'class' => $info['class'],
                        'email' => $info['email'],
                        'phone' => $info['phone'],
                        'gender' => $info['gender'],
                        'address' => $info['address'],
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
        return true;
    }

    public function getClassName($teacher_number){
        $result = [];
        $data = InfoTeachers::select('classes.class_name')
                        ->join('tkbofteachers','infoTeachers.teacher_number','=','tkbofteachers.teacher_number')
                        ->join('classes','tkbofteachers.class','=','classes.class_name')
                        ->where('infoTeachers.teacher_number',$teacher_number)
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;             
    }
}

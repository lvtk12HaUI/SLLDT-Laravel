<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InfoStudents extends Model
{
    protected $table = 'infostudents';

    public function checkAddInfoStudents($student_number){
        $result = [];
        $data = InfoStudents::select('InfoStudents.student_number','InfoStudents.student_name','InfoStudents.birthday','InfoStudents.email',
        'InfoStudents.phone','InfoStudents.gender','InfoStudents.class','InfoStudents.address','classes.class_name')
                        ->join('classes','classes.id','=','InfoStudents.class') 
                        ->where([
                            'student_number' => $student_number,
                        ])
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function listInfoStudents($keyword){
        $result = [];
        $data = InfoStudents::select('InfoStudents.student_number','InfoStudents.student_name','InfoStudents.birthday','InfoStudents.email',
                                    'InfoStudents.phone','InfoStudents.gender','InfoStudents.class','InfoStudents.address','classes.class_name')
                        ->join('classes','classes.id','=','InfoStudents.class') 
                        ->where(function($query) use ($keyword){
                             $query->where('InfoStudents.student_number','LIKE',"%{$keyword}%");
                             $query->orwhere('InfoStudents.student_name','LIKE',"%{$keyword}%");
                             $query->orwhere('classes.class_name','LIKE',"%{$keyword}%");
                         })           
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getStudentsNumber($class_id){
        $result = [];
        $data = InfoStudents::select('student_number')
                                ->where('class',$class_id)
                                ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getClass($student_number){
        $result = [];
        $data = InfoStudents::select('class')
                        ->where('student_number',$student_number)
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function listInfoStudentsByClassId($class_id,$keyword){
        $result = [];
        $data = InfoStudents::select('student_number','student_name','birthday','email','phone','gender','class','address')
                        ->where('class',$class_id)
                        ->where(function($query) use ($keyword){
                            $query->where('InfoStudents.student_number','LIKE',"%{$keyword}%");
                            $query->orwhere('InfoStudents.student_name','LIKE',"%{$keyword}%");
                        }) 
                        ->orderBy('student_name', 'asc') 
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;

    }

    public function listInfoStudentsByClass($class){
        $result = [];
        $data = InfoStudents::select('InfoStudents.student_number','InfoStudents.student_name','InfoStudents.birthday','InfoStudents.email',
                                'InfoStudents.phone','InfoStudents.gender','InfoStudents.class','InfoStudents.address','classes.class_name')
                        ->join('classes','classes.id','=','InfoStudents.class')
                        ->where('classes.class_name',$class)
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;

    }

    public function getPhone($student_number){
        $data = InfoStudents::select('phone')
                        ->where('student_number',$student_number)
                        ->first();
        $data = $data->toArray();
        return $data;
    }

    public function getBirthDayStudent($student_number){
        $data = InfoStudents::select('birthday')
                        ->where([
                            'student_number' => $student_number,
                        ])
                        ->first();
        return $data;
    }

    public function getClassId($student_number){
        $result = [];
        $data = InfoStudents::select('classes.class_id','classes.class_name')
                        ->join('classes','classes.id','=','InfoStudents.class')
                        ->where('InfoStudents.student_number',$student_number)
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function updateInfoStudents($student_number,$info = []){
        InfoStudents::where('student_number',$student_number)
                    ->update([
                        'student_name' => $info['student_name'],
                        'birthday' => $info['birthday'],
                        'email' => $info['email'],
                        'phone' => $info['phone'],
                        'gender' => $info['gender'],
                        'class' => $info['class'],
                        'address' => $info['address'],
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
        return true;
    }

    public function checkStudentNumber($student_number){
        $result = [];
        $data = InfoStudents::select('*')
                        ->where('student_number',$student_number)
                        ->first();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function updateInfoStudents_2($student_number,$info = []){
        InfoStudents::where('student_number',$student_number)
                    ->update([
                        'student_number'=>$info['student_number'],
                        'student_name' => $info['student_name'],
                        'birthday' => $info['birthday'],
                        'email' => $info['email'],
                        'phone' => $info['phone'],
                        'gender' => $info['gender'],
                        'class' => $info['class'],
                        'address' => $info['address'],
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
        return true;
    }

    public function delInfoStudents($student_number){
        InfoStudents::where('student_number',$student_number)
                    ->delete();
        return true;
    }

    public function delStudentsByClass($class_id){
        InfoStudents::where('class',$class_id)
                    ->delete();
        return true;
    }

    

}

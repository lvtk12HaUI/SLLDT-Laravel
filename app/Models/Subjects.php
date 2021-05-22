<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subjects extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'subject_number','name','lop_6','lop_7','lop_8','lop_9'
    ];

    public $timestamps = false;

    public function getAllDataSubjects(){
        $result = [];
        $data = Subjects::select('id','subject_number','name','lop_6','lop_7','lop_8','lop_9')
                    ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getDataByClass($class_id){
        $result = [];
        $data = Subjects::select('subject_number','name')
                    ->where('lop_6',$class_id)
                    ->orWhere('lop_7',$class_id)
                    ->orWhere('lop_8',$class_id)
                    ->orWhere('lop_9',$class_id)
                    ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }
}

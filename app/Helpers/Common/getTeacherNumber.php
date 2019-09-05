<?php

namespace App\Helpers\Common;

class getTeacherNumber {

    public static function getTeachersNumber($teachers_number = [],$teacherNumberOfGVCN){
        $teachersNumber = [];
        foreach($teachers_number as $key => $val){
            array_push($teachersNumber,$val['teacher_number']);
        }
        array_unshift($teachersNumber,$teacherNumberOfGVCN);
        $teachersNumber = array_unique($teachersNumber);
        return $teachersNumber;
    }
    
}
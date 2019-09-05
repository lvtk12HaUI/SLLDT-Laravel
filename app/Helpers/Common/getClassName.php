<?php

namespace App\Helpers\Common;
use App\Models\InfoTeachers;
use App\Models\Classes;

class getClassName {

    public static function getClassName($teacher_number,InfoTeachers $infoTeachers,Classes $class){
            $className = $infoTeachers->getClassName($teacher_number);
            $class_name = [];
            foreach($className as $key => $val){
                array_push($class_name,$val['class_name']);
            }
            $class_name = array_unique($class_name);
            return $class_name;
    }
}
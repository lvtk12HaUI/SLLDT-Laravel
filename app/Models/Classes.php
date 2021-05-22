<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model
{
    protected $table = 'classes';

    const LOP6 = 6;
    const LOP7 = 7;
    const LOP8 = 8;
    const LOP9 = 9;

    public function getAllDataClasses(){
        $result = [];
        $data = Classes::select('classes.id','classes.class_name','rooms.name as room_name')
                        ->join('rooms','classes.room_id','=','rooms.id')
                        ->where([
                            'status' => 1,
                        ])
                        ->get();
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function getDataInfoClass($class_name = []){
        $data = [];
        foreach($class_name as $key => $val){
            $data[$key] = Classes::select('classes.id','classes.class_name','rooms.name as room_name')
                            ->join('rooms','classes.room_id','=','rooms.id')
                            ->where('classes.class_name',$val)
                            ->first();
            $data[$key] = $data[$key]->toArray();
        }
        return $data;
    }

    public function checkClassId($class_id){
        $result = [];
        $data = Classes::select('class_name')
                    ->where('id',$class_id)
                    ->first();
        if($data){
            $result = $data -> toArray();
        }
        return $result;
    }


    public function getClassId($class_id){
        $result = [];
        $data = Classes::select('class_id')
                    ->where('id',$class_id)
                    ->first();
        if($data){
            $result = $data -> toArray();
        }
        return $result;
    }

    public function getClassName($class_id){
        $result = [];
        $data = Classes::select('class_name')
                    ->where('id',$class_id)
                    ->first();
        if($data){
            $result = $data -> toArray();
        }
        return $result;
    }

    public function checkClassName($class_name){
        $result = [];
        $data = Classes::select('class_name', 'room_id')
                    ->where('class_name',$class_name)
                    ->first();
        if($data){
            $result = $data -> toArray();
        }
        return $result;
    }

    public function getRoomId($class_id){
        $result = [];
        $data = Classes::select('room_id')
                    ->where('id',$class_id)
                    ->first();
        if($data){
            $result = $data -> toArray();
        }
        return $result;
    }

    public function delClass($class_id){
        Classes::where('id',$class_id)
                    ->delete();
        return true;
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Rooms', 'room_id');
    }
}

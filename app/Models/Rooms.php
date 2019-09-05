<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rooms extends Model
{
    protected $table = 'rooms';

    public function getAllDataRooms(){
    	$result = [];
    	$data = Rooms::select('*')
    				->get();
    	if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function checkData($room_name){
    	$result = [];
    	$data = Rooms::select('*')
    				->where('name',$room_name)
    				->first();
    	if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function checkStudent($room_name){
    	$result = [];
    	$data = Rooms::select('rooms.id','rooms.name','classes.class_name')
    				->join('classes','rooms.id','=','classes.room_id')
    				->join('infoStudents','classes.id','=','infoStudents.class')
    				->where('name',$room_name)
    				->first();
    	if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function delRoom($room_name){
        Rooms::where('name',$room_name)
                    ->delete();
        return true;
    }

    public function ListAntiRooms(){
        $result = [];
        $data = Rooms::select('id','name')
                    ->where('status',0)
    				->get();
    	if($data){
            $result = $data->toArray();
        }
       return $result;
    }

    public function getClassIdByRoom($room_name){
        $result = [];
        $data = Rooms::select('classes.id')
                    ->join('classes','rooms.id','=','classes.room_id')
                    ->where('name',$room_name)
    				->first();
    	if($data){
            $result = $data->toArray();
        }
       return $result;
    }

    public function updateStatus1($room_id){
        Rooms::where('id',$room_id)
                ->update([
                    'status' => 1
                ]);
        return true;
    }

    public function updateStatus2($room_id){
        Rooms::where('id',$room_id)
                ->update([
                    'status' => 0
                ]);
        return true;
    }

}

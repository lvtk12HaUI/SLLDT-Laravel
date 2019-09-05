<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Accounts extends Model
{
    protected $table = 'accounts';

    public function loginAdmin($user,$pass){
    	$result = [];
    	$data = Accounts::select('*')
    				->where([
    					'username' => $user,
    					'password' => $pass,
    					'status' => 1,
    				])
    				->first();
    	if($data){
    		$result = $data->toArray();
    	}
    	return $result;
	}
	
	public function checkLogin($user,$pass){
		$result = [];
		$role = Accounts::select('role')
    				->where([
    					'username' => $user,
    					'password' => $pass,
    					'status' => 1,
    				])
    				->first();
		if($role){
			$result = $role->toArray();
		}
		return $result;
	}

	public function checkRole($user){
		$result = [];
		$role = Accounts::select('role')
    				->where([
    					'username' => $user,
    					'status' => 1
    				])
    				->first();
		if($role){
			$result = $role->toArray();
		}
		return $result;
	}

	public function updateAccounts($student_number,$acc = []){
		Accounts::where('username',$student_number)
				->update([
					'username' => $acc['username'],
					'updated_at' => $acc['updated_at']
				]);
		return true;
	}

	public function delAccounts_1($student_number){
        Accounts::where('username',$student_number)
                    ->delete();
        return true;
	}
	
	public function delAccounts_2($student_number){
        Accounts::where('username',$student_number)
                    ->delete();
        return true;
	}
	
	public function checkAccount($username){
		$result = [];
		$data = Accounts::select('*')
						->where([
							'username' => $username,
						])
						->first();
		if($data){
			$result = $data->toArray();
		}
		return $result;
	}

	public function checkPass($username,$pass){
		$result = [];
		$data = Accounts::select('*')
						->where([
							'username' => $username,
							'password' => $pass,
						])
						->first();
		if($data){
			$result = $data->toArray();
		}
		return $result;
	}

	public function updatePass($username,$pass,$passNew){
		Accounts::where([
			'username' => $username,
			'password' => $pass,
		])
				->update([
					'password'=>$passNew,
					'updated_at' => date('Y-m-d H:i:s')
				]);
		return true;
	}

	public function updatePass2($username,$passNew){
		Accounts::where([
			'username' => $username,
		])
				->update([
					'password'=>$passNew,
					'updated_at' => date('Y-m-d H:i:s')
				]);
		return true;
	}
}

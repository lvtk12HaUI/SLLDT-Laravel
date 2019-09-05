<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Http\Requests\StoreLoginPost; 


class HandleLoginController extends Controller
{
    public function viewLogin(){  
    	return view('master.login.login');
    }

    public function handleLogin(StoreLoginPost $request,Accounts $account){
    	$user = $request->username;
        $pass = $request->password;
    	if($user && $pass){
    		$data = $account->loginAdmin($user,$pass);
    		if($data){
                //luu thong tin co ban vao session
                //cho di vao trang tru
                $request->session()->put('username',$data['username']);
                $request->session()->put('password',$data['password']);
                $request->session()->put('id',$data['id']);
                $role = $account->checkLogin($user,$pass);
                $role = $role['role'];
                $request->session()->put('role',$role);
                if($role == -1){
                    return redirect()->route('admin_homePage');
                }
                else if($role == 0){
                    return redirect()->route('teacher_homePage');
                }
                else if($role == 1){
                    return redirect()->route('student_homePage');
                }
    		}
            else{
                return redirect()->route('viewLogin',['state'=>'fail'])->with(['thongbao'=>'Tên đăng nhập hoặc mật khẩu không chính xác','username'=>$user]);
            }
    	}
        return view('master.login.login')->with('username',$user);
    }

    public function logout(Request $request)
    {
        // xoa het toan bo session dc tao ra o form login
        // cho quay ve form login
        $request->session()->forget('username');
        $request->session()->forget('password');
        $request->session()->forget('id');
        $request->session()->forget('role');
        return redirect()->route('viewLogin');
    }

}

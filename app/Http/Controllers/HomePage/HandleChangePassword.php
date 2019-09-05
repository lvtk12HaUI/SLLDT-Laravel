<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostPassword;
use App\Models\Accounts;
use Illuminate\Support\Facades\DB;

class HandleChangePassword extends Controller
{
    public function viewChangePassword($username,Request $request,Accounts $account){
        $user = $request->session()->get('username');
        if($user === $username){
            $role = $account->checkRole($username);
            if($role){
                if($role['role'] == -1){
                    return view('master.homePage.admin-homePage.change_password_admin');
                }
                else if($role['role'] == 0){
                    return view('master.homePage.teacher-homePage.change_password_teacher');
                }
                else if($role['role']  == 1){
                    return view('master.homePage.student-homePage.change_password_student');
                }
            }
            else{
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }

    public function HandleChangePassword($username,StorePostPassword $request,Accounts $account){
        $pass = $request->pass;
        $passNew = $request->PassNew;
        $RetypePassNew = $request->RetypePassNew;
        if(strcmp($passNew,$RetypePassNew) == 0){
            $checkPass = $account->checkPass($username,$pass);
            if($checkPass){
                $updatePass = $account->updatePass($username,$pass,$passNew);
                if($updatePass){
                    $request->session()->forget('username');
                    $request->session()->forget('password');
                    $request->session()->forget('id');
                    $request->session()->forget('role');
                    return redirect()->route('viewLogin')->with('username',strtolower($username));
                }
                else{
                    return back();
                }
            }
            else{
                return back()->withInput()->with('passNotFound','Mật khẩu hiện tại không chính xác');
            }
        }
        else{
            return back()->withInput()->with('notification','Mật khẩu không trùng khớp');
        }
        
    }
}

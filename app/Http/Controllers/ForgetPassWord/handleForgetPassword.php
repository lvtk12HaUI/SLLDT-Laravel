<?php

namespace App\Http\Controllers\ForgetPassWord;
require '../vendor/autoload.php';

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Accounts,InfoStudents};
use App\Http\Requests\StoreForgotPass; 

class handleForgetPassword extends Controller
{
    public function viewForgotPassword(){
        return view('master.login.forget_password');
    }

    public function handleForgetPassword(StoreForgotPass $request,Accounts $account,InfoStudents $info){
        $maHS = $request->maHS;
        $check = $info->checkAddInfoStudents($maHS);
        if($check){
            $phone = $info->getPhone($maHS);
            $phone = $phone['phone'];
            $phone = explode('0', $phone, 2);
            $phone = $phone['1'];
            $phone = "+84".$phone;
            $newPass = "123456";
            $message = "Mật khẩu mới của bạn là: ".$newPass.".Vui lòng đăng nhập và đổi lại mật khẩu mới để đảm bảo an toàn cho tài khoản của bạn.";
            
            //send sms
            // Your Account SID and Auth Token from twilio.com/console
            $account_sid = 'AC56d0e9245153f7275f29caa7ed7cfa93';
            $auth_token = '97b4fbf03105cb9a224448afb6160603';
            // In production, these should be environment variables. E.g.:
            // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
    
            // A Twilio number you own with SMS capabilities
            $twilio_number = "+12563716562";
    
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                // Where to send a text message (your cell phone?)
                $phone,
                array(
                    'from' => $twilio_number,
                    'body' => $message
                )
            );

            $checkUpdatePass = $account->updatePass2($maHS,$newPass);
            if($checkUpdatePass){
                return redirect()->route('viewLogin');
            }
            
        }
        else{
            return back()->withInput()->with('notification','Mã học sinh không tồn tại');
        }
    }
}

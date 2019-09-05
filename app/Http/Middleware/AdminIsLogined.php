<?php

namespace App\Http\Middleware;

use Closure;

class AdminIsLogined
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $user = $request->session()->get('username');
        $id = $request->session()->get('id');
        $role = $request->session()->get('role');
        if($this->adminIsLogined($id, $user)){
            if($role == -1){
                return redirect()->route('admin_homePage');
            }
            else if($role == 0){
                return redirect()->route('teacher_homePage');
            }
            else if($role == 1){
                return redirect()->route('student_homePage');
            }
            else{
                abort(404);
            }
        }
        return $next($request);
    }

    private function adminIsLogined($id,$user){
        $id = (is_numeric($id) && $id >0) ? true : false;
        $user = empty($user) ? false : true;
        if($id && $user){
            return true;
        }
        return false;
    }
}

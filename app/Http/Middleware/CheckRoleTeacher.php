<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = $request->session()->get('role');
        if($role != 0){
            abort(404);
        }
        return $next($request);
    }
}

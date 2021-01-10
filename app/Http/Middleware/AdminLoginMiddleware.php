<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
        if(Auth::check())
        {
            $user=Auth::user();
            if($user->level=='admin')
                return $next($request);
            else
                return redirect('dangnhap');
        }
        return redirect('dangnhap')->with(['thongbao'=>'Hãy đăng nhập tài khoản admin','flag'=>'danger']);
    }
}

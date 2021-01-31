<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminUserMiddleware
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
            if($user->level==2)
                return $next($request);
            else
                return redirect('admin/dashboard')->with(['thongbao'=>'Bạn không có quyền truy cập quản lý tài khoản!','flag'=>'admin_danger']);
        }
        return redirect('admin/dashboard')->with(['thongbao'=>'Bạn không có quyền truy cập quản lý tài khoản!','flag'=>'admin_danger']);
    }
}

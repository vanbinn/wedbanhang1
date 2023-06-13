<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //dd("phải cần có quyền truy cập admin hoặc kỹ thuật viên");
        if(Auth::check()){
            $user=Auth::user();
            if ($user->level->id === 1 || $user->level->id === 2) {
                return $next($request);
            } else {
                return redirect('admim');
            }
            
            
            
            
            
        }
        else {
            return redirect('login');
        }
    }
}

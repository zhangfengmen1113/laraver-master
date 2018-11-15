<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthMiddleware
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
        //检测是否登录
        //dd(!auth()->check());
        //dd(auth()->user());
        if(!auth()->check() || auth()->user()->is_admin != 1){
             return redirect()->route('index');
        }

        return $next($request);
    }
}

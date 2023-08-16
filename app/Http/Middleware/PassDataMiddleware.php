<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class PassDataMiddleware
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
        $count_user = User::count();
        //    if(isset($request->user()->user_roles)){
        //     $user_roles=$request->user()->user_roles;
        //     if($user_roles)
        //    }
           
       
        // view()->share('count_user', $count_user);
        view()->share('test', 'test');
        return $next($request);
    }
}

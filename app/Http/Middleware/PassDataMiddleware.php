<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Apropos;
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
        $roles=array();
        $count_user = User::count();
        $apropos = Apropos::first();
           if(isset($request->user()->user_roles)){
            $user_roles=$request->user()->user_roles;
            foreach($user_roles as $user_role){
                array_push($roles,$user_role->role->nom);
            }
           
        }
       
        view()->share('count_user', $count_user);
        view()->share('apropos', $apropos);
        return $next($request);
    }
}

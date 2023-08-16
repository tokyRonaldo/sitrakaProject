<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,string $role)
    {
        // dd($request->user()->user_roles-);
        if(isset($request->user()->user_roles)){
            $user_roles=$request->user()->user_roles;
            foreach($user_roles as $user_role){
                // dd($user_role->id);
        if($user_role->role->where('nom',$role)->exists()){
            return $next($request);
        }
        
        
    }
    abort(403);
}
else{
    return redirect('login');
}
// abort(403);
}
}

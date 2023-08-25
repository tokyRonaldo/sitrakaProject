<?php

namespace App\Providers;

use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//  
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
           $roles = [];

            $user = Auth::user(); // Utilisez la méthode Auth::user() pour accéder à l'utilisateur authentifié

            if ($user && $user->user_roles) {
                foreach ($user->user_roles as $user_role) {
                    array_push($roles, $user_role->role->nom);
                }
            }

            $view->with('roles', $roles);
            session(['roles' => $roles]);
        });
    }
}

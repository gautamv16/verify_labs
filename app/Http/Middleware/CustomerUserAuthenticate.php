<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CustomerUserAuthenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request,Closure $next)
    {
             if (Auth::guard('admins')->check())
            {

                if(Auth::guard('admins')->user()->role->role_key == 'customer')
                {
                    return $next($request);
                }
           }
           return redirect('/admin/login');
    }
}

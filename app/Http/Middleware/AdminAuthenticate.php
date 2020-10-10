<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminAuthenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request,Closure $next)
    {
         if (!Auth::guard('admins')->check()) {
            return redirect('/admin/login');
        }
        return $next($request);
    }
}

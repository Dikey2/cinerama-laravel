<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Si el usuario ya está autenticado, lo redirige según su rol.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // 👇 Redirige a admin si es administrador
                if ($user->is_admin) {
                    return redirect('/admin/movies');
                } 
                
                // 👇 Redirige al HOME real del usuario normal
                return redirect('/');
            }
        }

        return $next($request);
    }
}





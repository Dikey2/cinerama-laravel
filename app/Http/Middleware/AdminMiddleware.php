<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Verifica que el usuario esté logueado y tenga rol admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Si NO está logueado → redirigir al login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debes iniciar sesión.');
        }

        // 2. Si su rol NO es admin → prohibir acceso
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Acceso denegado.');
        }

        // 3. Todo OK → continuar
        return $next($request);
    }
}




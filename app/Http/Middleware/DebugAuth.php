<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebugAuth
{
    public function handle(Request $request, Closure $next)
    {
        logger('🧩 Ruta: ' . $request->path());
        logger('Auth check: ' . (Auth::check() ? '✅ Logueado' : '❌ No logueado'));
        logger('Usuario actual: ' . (Auth::check() ? Auth::user()->email : 'ninguno'));

        return $next($request);
    }
}

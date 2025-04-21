<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            Log::info('Usuario autenticado, redirigiendo a /myArticles');
            return redirect('/myArticles');
        }
    
        Log::info('Usuario no autenticado, continuando con la solicitud');
        return $next($request);
    }
}

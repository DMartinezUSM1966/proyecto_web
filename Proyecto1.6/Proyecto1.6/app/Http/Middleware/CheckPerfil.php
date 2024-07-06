<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPerfil
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->cargo == 1) {
            return $next($request);
        }

        return redirect()->route('home.inicio')->with('error', 'No tienes permiso para realizar esa acción');
    }
}

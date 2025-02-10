<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Obtén el rol del usuario autenticado
        $userRole = Auth::user()->role->id;


        // Verifica si el rol del usuario está en los roles permitidos
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder a esta página.');

    }
}

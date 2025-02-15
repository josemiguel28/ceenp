<?php

namespace App\Http\Middleware;

use App\Enums\UserRoles;
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
    public function handle(Request $request, Closure $next, ...$allowedRoles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $userRole = $user->role->id;

        // Verifica si el rol del usuario está en los roles permitidos
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        $route = $this->getDashboardRouteForRole($userRole);

        $errorMessage = 'No tienes permisos para acceder a esta página. Has sido redirigido a tu dashboard.';

        return redirect()->route($route)->with('error', $errorMessage);
    }

    /**
     * Devuelve la ruta del dashboard correspondiente al rol del usuario.
     */
    protected function getDashboardRouteForRole(int $role): string
    {
        switch ($role) {
            case UserRoles::ADMIN:
                return 'dashboard';
            case UserRoles::ESTUDIANTE:
                return 'estudiante.dashboard.index';
            case UserRoles::MAESTRO:
                return 'maestro.dashboard.index';
            default:

                return '/';
        }
    }
}

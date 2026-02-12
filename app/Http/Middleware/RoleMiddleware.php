<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        // Si el usuario NO tiene rol, solo puede ir a elegir rol
        if (!$user->role) {
            if ($request->routeIs('choose.role') || $request->routeIs('choose.role.store')) {
                return $next($request);
            }

            return redirect()->route('choose.role');
        }

        // Rol normal
        if (!in_array($user->role, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }

}

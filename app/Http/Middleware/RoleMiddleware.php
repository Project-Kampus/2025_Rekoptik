<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        $roles = explode('|', $roles); // contoh: 'admin|manager'

        $user = auth()->user();

        if (!$user || !collect($roles)->contains(fn($role) => $user->hasRole($role))) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}

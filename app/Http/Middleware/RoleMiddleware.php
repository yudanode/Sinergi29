<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Reset cached roles
        $request->user()->unsetRelation('roles');

        if (!$request->user()->hasAnyRole($roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}

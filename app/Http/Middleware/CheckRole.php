<?php
namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            return response()->json(['message' => 'Access Denied'], 403);
        }
        return $next($request);
    }
}


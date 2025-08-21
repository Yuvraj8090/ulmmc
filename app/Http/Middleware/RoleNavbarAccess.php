<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleNavbarAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $user = auth()->user();
    $currentSlug = $request->route()->uri();

    $allowedSlugs = $user->role->navbarItems->pluck('slug')->toArray();

    if (!in_array($currentSlug, $allowedSlugs) && $user->role->name !== 'Super Admin') {
        abort(403, 'Unauthorized');
    }

    return $next($request);
}

}

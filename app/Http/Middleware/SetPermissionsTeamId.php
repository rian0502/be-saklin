<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;
use Symfony\Component\HttpFoundation\Response;

class SetPermissionsTeamId
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            app(PermissionRegistrar::class)
                ->setPermissionsTeamId($request->user()->outlet_id);
        }

        return $next($request);
    }
}

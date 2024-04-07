<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Couchbase\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->hasAnyAdminPermissions()) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}

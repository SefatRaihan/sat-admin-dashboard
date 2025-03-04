<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // `active_role_id == 1` hole full access
        if ($user && $user->active_role_id == 1) {
            return $next($request);
        }

        $controller = class_basename($request->route()->getController());
        $method = $request->route()->getActionMethod();

        $hasPermission = $user->role->permissions()
            ->where('controller', $controller)
            ->where('method', $method)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}


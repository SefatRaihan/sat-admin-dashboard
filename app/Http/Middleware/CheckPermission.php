<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Allow full access for active_role_id == 1
        if ($user && $user->active_role_id == 1) {
            return $next($request);
        }

        // Get the controller and method from the route
        $controller = $request->route()->getController();
        $controllerName = class_basename($controller);
        $method = $request->route()->getActionMethod();

        // Format controller name to match the stored format (e.g., RoleNavItemApiController -> Role Nav Item Api)
        $formattedControllerName = preg_replace('/(?<!^)([A-Z])/', ' $1', str_replace('Controller', '', $controllerName));

        // Check if controller has visiblePermissions
        $visiblePermissions = [];
        try {
            $controllerClass = new \ReflectionClass($controller);
            if ($controllerClass->hasProperty('visiblePermissions')) {
                $property = $controllerClass->getProperty('visiblePermissions');
                $property->setAccessible(true);
                $visiblePermissions = $property->getValue();
            }
        } catch (\ReflectionException $e) {
            // Handle cases where the controller class cannot be reflected
            \Log::error('Reflection error for controller: ' . $controllerName, ['error' => $e->getMessage()]);
        }

        // Use the visiblePermissions method name if available, otherwise use the original method name
        $permissionMethod = $visiblePermissions && array_key_exists($method, $visiblePermissions) ? $visiblePermissions[$method] : $method;

        // Check if the user has the permission
        $hasPermission = $user->role->permissions()
            ->where('controller', $formattedControllerName)
            ->where('method', $permissionMethod)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}

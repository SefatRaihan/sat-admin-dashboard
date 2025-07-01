<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RoleManagementController extends Controller
{
    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'edit' => 'Edit Form',
        'update' => 'Update',
        'destroy' => 'Delete',
    ];

    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('backend.role-managements.index', compact('roles'));
    }

    public function create()
    {
        $controllers = $this->getControllersWithMethods();
        return view('backend.role-managements.create', compact('controllers'));
    }

    public function store(Request $request)
    {
        try {
            $role = Role::create([
                'uuid'          => Str::uuid(),
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'description'   => $request->name . ' role'
            ]);

            if ($request->has('permissions')) {
                foreach ($request->permissions as $controller => $methods) {
                    foreach ($methods as $method) {
                        RolePermission::create([
                            'role_id' => $role->id,
                            'controller' => $controller,
                            'method' => $method,
                        ]);
                    }
                }
            }

            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $controllers = $this->getControllersWithMethods();

        // Get the role's permissions
        $rolePermissions = RolePermission::where('role_id', $id)
            ->get()
            ->map(function ($permission) {
                return $permission->controller . '.' . $permission->method;
            })->toArray();

        return view('backend.role-managements.edit', compact('role', 'controllers', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|unique:roles,name,' . $id,
                'permissions' => 'nullable|array',
            ]);

            // Find the role
            $role = Role::findOrFail($id);

            // Update role details
            $role->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->name . ' role'
            ]);

            // Delete existing permissions
            RolePermission::where('role_id', $role->id)->delete();

            // Add new permissions
            if ($request->has('permissions')) {
                foreach ($request->permissions as $controller => $methods) {
                    foreach ($methods as $method) {
                        RolePermission::create([
                            'role_id' => $role->id,
                            'controller' => $controller,
                            'method' => $method,
                        ]);
                    }
                }
            }

            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    private function getControllersWithMethods()
    {
        $excludedControllers = [
            'CsrfCookieController',
            'AuthenticatedSessionController',
            'RegisteredUserController',
            'PasswordResetLinkController',
            'NewPasswordController',
            'EmailVerificationNotificationController',
            'ConfirmablePasswordController',
            'PasswordController'
        ];

        $controllers = [];
        foreach (Route::getRoutes() as $route) {
            $controllerAction = $route->getActionName();
            if (strpos($controllerAction, '@') !== false) {
                list($controller, $method) = explode('@', $controllerAction);
                $controllerName = class_basename($controller);

                if (in_array($controllerName, $excludedControllers)) {
                    continue;
                }

                // Format controller name for display (e.g., RoleNavItemApiController -> Role Nav Item Api)
                $displayControllerName = preg_replace('/(?<!^)([A-Z])/', ' $1', str_replace('Controller', '', $controllerName));

                if (!isset($controllers[$displayControllerName])) {
                    $controllers[$displayControllerName] = [];
                }

                // Check if controller has visiblePermissions
                $controllerClass = new \ReflectionClass($controller);
                $visiblePermissions = [];
                if ($controllerClass->hasProperty('visiblePermissions')) {
                    $property = $controllerClass->getProperty('visiblePermissions');
                    $property->setAccessible(true);
                    $visiblePermissions = $property->getValue();
                }

                // If visiblePermissions exists, use it; otherwise, use the method name
                if (!empty($visiblePermissions) && array_key_exists($method, $visiblePermissions)) {
                    $displayMethod = $visiblePermissions[$method];
                } else {
                    $displayMethod = $method;
                }

                if (!in_array($displayMethod, $controllers[$displayControllerName])) {
                    $controllers[$displayControllerName][] = $displayMethod;
                }
            }
        }

        // Sort controllers and methods for consistent display
        ksort($controllers);
        foreach ($controllers as &$methods) {
            sort($methods);
        }

        return $controllers;
    }
}

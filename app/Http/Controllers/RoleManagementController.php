<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Route;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Str;

class RoleManagementController extends Controller
{
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
        }catch(QueryException $e){
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);


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
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
    
    // Keep your existing getControllersWithMethods method
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
    
                if (!isset($controllers[$controllerName])) {
                    $controllers[$controllerName] = [];
                }
    
                if (!in_array($method, $controllers[$controllerName])) {
                    $controllers[$controllerName][] = $method;
                }
            }
        }
        return $controllers;
    }
    
}

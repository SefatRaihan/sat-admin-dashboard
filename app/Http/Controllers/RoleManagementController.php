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
        $roles = Role::with('permissions')->get();
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
                    continue; // Skip excluded controllers
                }
    
                if (!isset($controllers[$controllerName])) {
                    $controllers[$controllerName] = [];
                }
    
                $controllers[$controllerName][] = $method;
            }
        }
        return $controllers;
    }
    
}

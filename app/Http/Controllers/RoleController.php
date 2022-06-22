<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware(['auth:admin-api', 'scope:admin']);
        // $this->middleware(['auth:api', 'scopes:edit,create,delete'])->except(['index', 'show']);
    }

    public function index()
    {
        $roles = $this->role::all();
        $roles->transform(function($role){
            $role->rolePermissions = $role->getPermissionNames();
            return $role;
        });

        return response()->json([
        'roles' => $roles
        ], 200);
    }

    public function getAllRoles()
    {
        $roles = $this->role::all();

        return response()->json([
        'roles' => $roles
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string|unique:roles',
            'permission' => 'nullable'
        ]);

        $role = $this->role->create([
            'name' => $request->name
        ]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return response()->json('success', 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::latest()->get();

        return response()->json([
            'admins' => $admins
        ], 200);
    }

    public function getAllAdmins()
    {
        $admins = Admin::get();
        $admins->transform(function($admin){
            $admin->role = $admin->getRoleNames()->first();
            $admin->adminPermissions = $admin->getPermissionNames();
            return $admin;
        });

        return response()->json([
            'admins' => $admins
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
            'name' => 'required|string',
            'phone' => 'required',
            'identification' => 'required|unique:admins',
            'password' => 'required|alpha_num|min:6',
            'role' => 'required',
            'email' => 'required|email|unique:admins'
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->identification = $request->identification;
        $admin->random = rand(9999, 99999);
        $admin->password = bcrypt($request->email);

        $admin->assignRole($request->role);
        if ($request->has('permissions')) {
            $admin->givePermissionTo($request->permissions);
        }
        $admin->save();

        return response()->json('success', 200);

    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'identification' => 'required',
            'password' => 'nullable|alpha_num|min:6',
            'role' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id
        ]);

        $admin = Admin::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->identification = $request->identification;

        if ($request->has('password')) {
            $admin->password = bcrypt($request->password);
        }

        if ($request->has('role')) {
            $adminRole = $admin->getRoleNames();
            foreach ($adminRole as $role) {
                $admin->removeRole($role);
            }

            $admin->assignRole($request->role);
        }

        if ($request->has('permissions')) {
            $adminPermissions = $admin->getPermissionNames();
            foreach ($adminPermissions as $permission) {
                $admin->revokePermissionTo($permission);
            }

            $admin->givePermissionTo($request->permissions);
        }

        $admin->save();

        return response()->json('success', 200);
    }

    public function destroy(Admin $admin)
    {
        //
    }

    public function delete($id)
    {
        // return $id;
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return response()->json('success', 200);
    }
}

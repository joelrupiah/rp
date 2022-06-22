<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:admins'],
            'phone' => ['required', 'unique:admins'],
            'identification' => ['required', 'unique:admins'],
            'random' => ['required', 'unique:admins'],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'identification' => $request->identification,
            'random' => $request->random,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Register request complete',
            'status_code' => 200
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
            
        }

        return $admin->createToken('Admin Token', ['admin'])->accessToken;
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }

}

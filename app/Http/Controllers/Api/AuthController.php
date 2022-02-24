<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\Department;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registerForm(){
        $departments = Department::all();
        return view('registerForm', compact('departments'));
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|unique:users',
            'phone_number' => 'required',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        $token = $user->createToken('authtoken')->plainTextToken;
        $result = new RegisterResource($user);
        return $this->success($result);
    }

    public function loginForm(){
        return view('loginform');
    }
    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        // Check email
        $user = User::where('email', $fields['email'])->first();
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return $this->failed();
        }
        $result = new LoginResource($user);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $result->token = $token;
        return $this->success($result);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }

}

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
        return view('registerForm');
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'department_id' => 'required|string|max:10|unique:departments',
            'password' => 'required|string|confirmed',
        ]);
        $department = Department::create([
            'department_id' => $request->department_id,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($department));
        $token = $department->createToken('authtoken')->plainTextToken;
        $result = new RegisterResource($department);
        return $this->success($result);
    }

    public function loginForm(){
        return view('loginform');
    }
    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'department_id' => 'required|string|max:10',
            'password' => 'required|string'
        ]);
        // Check department_id
        $department = Department::where('department_id', $fields['department_id'])->first();
        // Check password
        if(!$department || !Hash::check($fields['password'], $department->password)) {
            return $this->failed();
        }
        $result = new LoginResource($department);
        $token = $department->createToken('myapptoken')->plainTextToken;
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

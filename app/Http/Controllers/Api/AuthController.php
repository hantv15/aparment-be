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
            'username' => 'required',
            'password' => 'required|string'
        ]);
        // Check email
        $count_user_by_email = User::where('email', $fields['username'])->count();
        $count_user_by_phone = User::where('phone_number', $fields['username'])->count();
        $user_by_email = User::where('email', $fields['username'])->first();
        $user_by_phone = User::where('phone_number', $fields['username'])->first();
        // Check password
        if ($count_user_by_email > 0) {
            if(!$user_by_email || !Hash::check($fields['password'], $user_by_email->password)) {
                return $this->failed();
            }
            $result = new LoginResource($user_by_email);
            $token = $user_by_email->createToken('myapptoken')->plainTextToken;
            $result->token = $token;
            return $this->success($result);
        } elseif ($count_user_by_phone > 0) {
            if(!$user_by_phone || !Hash::check($fields['password'], $user_by_phone->password)) {
                return $this->failed();
            }
            $result = new LoginResource($user_by_phone);
            $token = $user_by_phone->createToken('myapptoken')->plainTextToken;
            $result->token = $token;
            return $this->success($result);
        }
        
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }

}

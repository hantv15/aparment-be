<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function registerForm(){
        return view('registerForm');
    }
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        
        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $token = $user->createToken('authtoken')->plainTextToken;
        $result = new RegisterResource($user);
        return $this->success($result,$token);


    }

    public function loginForm(){
        return view('loginform');
    }
    public function login(Request $request): JsonResponse
    {
    $fields = $request->validate([
        'user_name' => 'required|string',
        'password' => 'required|string'
    ]);

    // Check email
    $user = User::where('user_name', $fields['user_name'])->first();

    // Check password
    if(!$user || !Hash::check($fields['password'], $user->password)) {
        return $this->success([
            'message' => 'User or password incorrect'
        ], 401);
    }
    $result = new LoginResource($user);
   
    $token = $user->createToken('myapptoken')->plainTextToken;
    

    return $this->success($result,$token,201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}
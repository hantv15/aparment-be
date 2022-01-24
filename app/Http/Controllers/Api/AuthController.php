<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function registerForm(){
        return view('registerForm');
    }
    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        // , Password::defaults()
        $user = User::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $token = $user->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Registered',
                'data'=> ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );

    }

    public function loginForm(){
        return view('loginform');
    }
    public function login(Request $request)
    {
    //     $request->authenticate();


    //     $token = $request->user()->createToken('authtoken');

    //    return response()->json(
    //        [
    //            'is_success'=>true,
    //            'message'=>'Login successfully',
    //            'data'=> [
    //                'user'=> $request->user(),
    //                'token'=> $token->plainTextToken
    //            ]
    //            ],200
    //     );
    $fields = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string'
    ]);

    // Check email
    $user = User::where('email', $fields['email'])->first();

    // Check password
    if(!$user || !Hash::check($fields['password'], $user->password)) {
        return response([
            'message' => 'Bad creds'
        ], 401);
    }

    $token = $user->createToken('myapptoken')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
    }

    public function logout(Request $request)
    {

        // $request->user()->tokens()->delete();

        // return response()->json(
        //     [
        //         'message' => 'Logged out'
        //     ]
        // );
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

}
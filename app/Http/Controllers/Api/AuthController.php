<?php

namespace App\Http\Controllers\Api;

use App\Models\Building;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function registerForm()
    {
        $apartments = Apartment::where('user_id', NULL)->get();
        return view('auth.register', compact('apartments'));
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|unique:users',
            'phone_number' => 'required|unique:users',
            'apartment_id' => 'required|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'apartment_id' => $request->apartment_id,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'dob' => $request->dob,
        ]);

        $apartment = Apartment::where('id', $request->apartment_id)->first();
        $apartment->user_id = $user->id;
        $apartment->save();

        $building = Building::where('id', $apartment->building_id)->first();

        event(new Registered($user));
        $token = $user->createToken('authtoken')->plainTextToken;

        Mail::send('email.form-register-success', [
            'name' => $request->name,
            'apartment_id' => $apartment->apartment_id,
            'building_name' => $building->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => $request->password
        ], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('chúc mừng tạo tài khoản thành công!');
        });

        $result = new RegisterResource($user);
        return $this->success($result);
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required|string'
        ]);
        // Check apartment_id, email or phone number
        $count_user_by_apartment_id = Apartment::where('apartment_id', $fields['username'])->count();
        $count_user_by_email = User::where('email', $fields['username'])->count();
        $count_user_by_phone = User::where('phone_number', $fields['username'])->count();

        $user_by_apartment_id = User::join('apartments', 'users.apartment_id', '=', 'apartments.id')
                                    ->select(
                                        'users.id',
                                        'users.email',
                                        'users.phone_number',
                                        'users.password',
                                        'users.name',
                                        'users.dob',
                                        'users.number_card',
                                        'users.status',
                                        'users.apartment_id',
                                        'users.avatar',
                                        'apartments.apartment_id as apartment_name',
                                        'apartments.floor',
                                        'apartments.description',
                                        'apartments.square_meters',
                                        'apartments.type_apartment',
                                        'apartments.building_id',
                                        'apartments.user_id'
                                    )
                                    ->where('apartments.apartment_id', $fields['username'])
                                    ->first();
        $user_by_email = User::join('apartments', 'users.apartment_id', '=', 'apartments.id')
                            ->select(
                                'users.id',
                                'users.email',
                                'users.phone_number',
                                'users.password',
                                'users.name',
                                'users.dob',
                                'users.number_card',
                                'users.status',
                                'users.apartment_id',
                                'users.avatar',
                                'apartments.apartment_id as apartment_name',
                                'apartments.floor',
                                'apartments.description',
                                'apartments.square_meters',
                                'apartments.type_apartment',
                                'apartments.building_id',
                                'apartments.user_id'
                            )
                            ->where('email', $fields['username'])
                            ->first();
        $user_by_phone = User::join('apartments', 'users.apartment_id', '=', 'apartments.id')
                            ->select(
                                'users.id',
                                'users.email',
                                'users.phone_number',
                                'users.password',
                                'users.name',
                                'users.dob',
                                'users.number_card',
                                'users.status',
                                'users.apartment_id',
                                'users.avatar',
                                'apartments.apartment_id as apartment_name',
                                'apartments.floor',
                                'apartments.description',
                                'apartments.square_meters',
                                'apartments.type_apartment',
                                'apartments.building_id',
                                'apartments.user_id'
                            )
                            ->where('phone_number', $fields['username'])
                            ->first();
        // Check password
        if ($count_user_by_email > 0) {
            if (!$user_by_email || !Hash::check($fields['password'], $user_by_email->password)) {
                return $this->failed('string');
            }
            $result = new LoginResource($user_by_email);
            $token = $user_by_email->createToken('myapptoken')->plainTextToken;
            $result->token = $token;
            Auth::attempt(['email' => $request->username, 'password' => $request->password], $request->remember);
            return $this->success($result);
        } elseif ($count_user_by_phone > 0) {
            if (!$user_by_phone || !Hash::check($fields['password'], $user_by_phone->password)) {
                return $this->failed('string');
            }
            $result = new LoginResource($user_by_phone);
            $token = $user_by_phone->createToken('myapptoken')->plainTextToken;
            $result->token = $token;
            Auth::attempt(['phone_number' => $request->username, 'password' => $request->password], $request->remember);
            return $this->success($result);
        } elseif ($count_user_by_apartment_id > 0) {
            if (!$user_by_apartment_id || !Hash::check($fields['password'], $user_by_apartment_id->password)) {
                return $this->failed('string');
            }
            $result = new LoginResource($user_by_apartment_id);
            $token = $user_by_apartment_id->createToken('myapptoken')->plainTextToken;
            $result->token = $token;
            Auth::attempt(['apartment_id' => $request->username, 'password' => $request->password], $request->remember);
            return $this->success($result);
        } else {
            return $this->failed('Failed login');
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->success('', 'Logged out');
    }
}

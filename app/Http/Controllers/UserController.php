<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegisterResource;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Ramsey\Collection\Collection as CollectionCollection;

class UserController extends Controller
{
    public function getUserLogin(Request $request)
    {
        $user = User::join('apartments', 'users.apartment_id', '=', 'apartments.id')
            ->join('buildings', 'apartments.building_id', '=', 'buildings.id')
            ->select(
                'users.name as ten_nguoi_dung',
                'users.phone_number',
                'users.email',
                'apartments.apartment_id',
                'buildings.name',
                'users.dob',
                'users.number_card',
                'users.avatar',
                'apartments.floor',
                'apartments.status',
                'apartments.square_meters'
            )
            ->where('users.id', $request->user()->id)
            ->get();
        return $this->success($user);
    }
    public function registerForm(): JsonResponse
    {
        $apartments = Apartment::where('user_id', NULL)->get();
        return $this->success($apartments);
    }
    public function saveUser(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|unique:users',
            'phone_number' => 'required|unique:users',
            'apartment_id' => 'required|unique:users',

        ]);
        $user = new User();
        $user->password = Hash::make('12345678');
        if ($request->hasFile('avatar')) {
            $imgPath = $request->file('avatar')->store('users');
            $imgPath = str_replace('public/', '', $imgPath);
            $user->avatar = $imgPath;
        }
        $user->fill($request->all());
        $user->save();
        $apartment = Apartment::where('id', $request->apartment_id)->first();
        $apartment->user_id = $user->id;
        $apartment->save();

        event(new Registered($user));
        $token = $user->createToken('authtoken')->plainTextToken;
        $result = new RegisterResource($user);
        return $this->success($result);
    }
    public function listUserById($id)
    {
        $user = User::join('apartments', 'users.id', '=', 'apartments.user_id')
            ->select(
                'users.id',
                'users.name as user_name',
                'users.email',
                'users.phone_number',
                'users.dob',
                'users.number_card',
                'users.status',
                'apartments.apartment_id'
            )
            ->where('users.id', $id)
            ->get();

        return $this->success($user);
    }
    public function saveEditUser(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|string|unique:users',
            'phone_number' => 'required|unique:users',
            'apartment_id' => 'required|unique:users',
        ]);
        if ($request->has('password')) {
            return $this->failed();
        }
    }
    public function removeUser($id)
    {
        $user = User::find($id);
        $apartment = Apartment::where('user_id', $user->id);
        $apartment->user_id = null;
        $apartment->save();
        $user->delete();
        return $this->success('');
    }
}

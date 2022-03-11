<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\RegisterResource;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
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

    public function registerForm()
    {
        $apartments = Apartment::where('user_id', NULL)->get();
        return view('user.add', compact('apartments'));
    }

    public function saveUser(UserRequest $request): JsonResponse
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

    public function formEditUser($id)
    {
        $user = User::find($id);
        $year = substr($user->dob, 0, 4);
        $month = substr($user->dob, 5, 2);
        $day = substr($user->dob, 8, 2);
        if (!$user) {
            return $this->failed();
        }
        $apartments = Apartment::where('user_id', NULL)
                            ->orWhere('user_id', $id)
                            ->get();
        return view('user.edit', compact('user', 'apartments', 'year', 'month', 'day'));
    }

    public function saveEditUser(UserRequest $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return $this->failed();
        }
        if($request->has('apartment_id')){
            $apartment_old = Apartment::where('user_id',$user->id)->first();
            $apartment_old->user_id=null;
            $apartment_old->save();
        }
        if($request->hasFile('avatar')){
            Storage::delete($user->avatar);
            $imgPath = $request->file('avatar')->store('user');
            $imgPath = str_replace('public/', '', $imgPath);
            $user->avatar = $imgPath;
        }
        $user->fill($request->all());
        $user->save();
        $apartment = Apartment::where('id', $request->apartment_id)->first();
        $apartment->user_id = $user->id;
        $apartment->save();
        return $this->success($user);
    }
    public function removeUser($id)
    {
        $user = User::find($id);
        if(!$user){
            return $this->failed();
        }
        $apartment = Apartment::where('user_id', $user->id)->first();
        $apartment->user_id = null;
        $apartment->save();
        $user->delete();
        return $this->success('');
    }
    public function getUserInfomationById($id)
    {
        $user = User::join('apartments', 'users.id', '=', 'apartments.user_id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email',
                'users.phone_number',
                'users.dob',
                'users.number_card',
                'users.status',
                'apartments.id',
                'apartments.apartment_id'
            )
            ->where('users.id', $id)
            ->get();

        return $this->success($user);
    }
}

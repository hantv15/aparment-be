<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUserLogin(Request $request): JsonResponse
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

    public function changePassword(Request $request)
    {
        $user = User::find($request->user()->id);
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed',
        ], [
            'password.required'  => 'Password không được để trống',
            'password.string'    => 'Password không có ký tự đặc biệt',
            'password.confirmed' => 'Password nhập lại sai',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return $this->success($user, 'Đổi mật khẩu thành công!');
    }

    public function getUser(Request $request)
    {
        $users = User::with('apartment')->paginate(10);
        if ($request->filled('keyword')) {
            $users = User::where('name', 'like', '%' . $request->keyword . '%')->get();
        }
        if ($request->filled('sort') && $request->sort == 1) {
            $users = $users->sortByDesc('name');
        } else if ($request->filled('sort') && $request->sort == 2) {
            $users = $users->sortBy('name');
        }
        if ($request->filled('page') && $request->filled('page_size')) {
            $users = $users->skip(($request->page - 1) * $request->page_size)->take($request->page_size);
        }
        return view('users.index', compact('users'));
    }

    public function registerForm()
    {
        $apartments = Apartment::where('user_id', null)->get();
        return view('users.add-user', compact('apartments'));
    }

    /**
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
    public function saveUser(RegisterUserRequest $request): RedirectResponse
    {
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
           return redirect()->route('user.index');
    }

    public function formEditUser($id)
    {
        $user = User::find($id);
        if (! $user) {
            return $this->failed();
        }
        $apartments = Apartment::where('user_id', null)
            ->orWhere('user_id', $id)
            ->get();
        return view('users.edit', compact('user', 'apartments'));
    }

    public function saveEditUser($id, RegisterUserRequest $request)
    {
        $user = User::find($id);
        if (! $user) {
           abort(404);
        }

        if ($request->has('apartment_id')) {
            $apartment_old = Apartment::where('user_id', $user->id)->first();
            $apartment_old->user_id = null;
            $apartment_old->save();
        }
        if ($request->hasFile('avatar')) {
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
        return redirect()->route('user.index')->with(['message' => 'Cập nhật thông tin user thành công']);
    }

    public function removeUser($id)
    {
        $user = User::find($id);
        if (! $user) {
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

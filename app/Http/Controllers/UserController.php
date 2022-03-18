<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password không có ký tự đặc biệt',
            'password.confirmed' => 'Password nhập lại sai'
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return $this->success($user, 'Đổi mật khẩu thành công!');
    }

    public function getUser(Request $request): JsonResponse
    {
        $user =User::all();
        if($request->filled('keyword')){
            $user = User::where('name','like','%' . $request->keyword . '%')->get();
        }
        if( $request->filled('sort') && $request->sort == 1){
            $user= $user->sortByDesc('name');
        }
        elseif(  $request->filled('sort') && $request->sort == 2){
            $user= $user->sortBy('name');
        }
        if ($request->filled('page') && $request->filled('page_size')){
            $user = $user->skip( ($request->page-1) * $request->page_size )->take($request->page_size);
        }
        $result = UserResource::collection($user);
        return $this->success($result);
    }

    public function registerForm()
    {
        $apartments = Apartment::where('user_id', NULL)->get();
        return view('user.add', compact('apartments'));
    }

    public function saveUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|email|unique:users',
                'phone_number' => 'required|unique:users',
                'apartment_id' => 'required|unique:users',
            ],
            [
                'email.required' => 'Email không được trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'phone_number.required' => 'Số điện thoại không được để trống',
                'phone_number.unique' => 'Số điện thoại đã tồn tại',
                'apartment_id.required' => 'Phòng không được để trống',
                'apartment_id.unique' => 'Phòng đã có người đăng ký',
            ]
        );
        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

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
        return $this->success($result, 'Thêm mới tài khoản thành công!');
    }

    public function formEditUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->failed();
        }
        $apartments = Apartment::where('user_id', NULL)
                            ->orWhere('user_id', $id)
                            ->get();
        return view('user.edit', compact('user', 'apartments'));
    }

    public function saveEditUser($id, Request $request): JsonResponse
    {
        $user = User::find($id);
        if(!$user){
            return $this->failed('User không tồn tại');
        }

        $validator = Validator::make($request->all(),
            [
                'email' => [
                    'required', 'email',
                    Rule::unique('users')->ignore($id)
                ],
                'phone_number' => [
                    'required',
                    Rule::unique('users')->ignore($id)
                ],
                'apartment_id' => 'required|unique:users',
            ],
            [
                'email.required' => 'Email không được trống',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'phone_number.required' => 'Số điện thoại không được để trống',
                'phone_number.unique' => 'Số điện thoại đã tồn tại',
                'apartment_id.required' => 'Phòng không được để trống',
                'apartment_id.unique' => 'Phòng đã có người đăng ký',
            ]
        );
        if ($validator->fails()) {
            return $this->failed($validator->messages());
        }

        if($request->has('apartment_id')){
            $apartment_old = Apartment::where('user_id',$user->id)->first();
            $apartment_old->user_id = NULL;
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
        return $this->success($user, 'Sửa thông tin tài khoản thành công');
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

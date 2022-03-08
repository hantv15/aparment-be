<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserLoginIn(Request $request){
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
}

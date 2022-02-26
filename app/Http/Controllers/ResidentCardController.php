<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResidentCardController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function getResidentCardByApartmentId($id): JsonResponse
    {
        $user_by_department_id = User::join('user_department', 'users.id', '=', 'user_department.user_id')
                                    ->join('departments', 'user_department.department_id', '=', 'departments.id')
                                    ->join('resident_cards', 'users.id', '=', 'resident_cards.user_id')
                                    ->join('vehicles', 'resident_cards.vehicle_id', '=', 'vehicles.id')
                                    ->select('resident_cards.card_id', 'users.user_name as ten', 'resident_cards.date_of_issue', 'resident_cards.plate_number', 'vehicles.name as tenxe')
                                    ->where('departments.id', $id)
                                    ->get();
        return $this->success($user_by_department_id);
    }
}

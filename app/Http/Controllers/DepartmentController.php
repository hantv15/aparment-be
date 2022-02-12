<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Apartment;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartment(Request $request): JsonResponse
    {

        $departments = Department::all();
        if ($request->filled('keyword')) {
            $departments = Department::join('users', 'departments.user_id', '=', 'users.id')
                                    ->select('departments.*', 'users.name', 'users.phone_number')
                                    ->where('users.phone_number', $request->keyword)
                                    ->orWhere('users.name', 'like', '%' . $request->keyword . '%')
                                    ->get();
        }
        // $result = DepartmentResource::collection($departments);
        $departments->load('bills');
        return $this->success($departments);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartment(Request $request): JsonResponse
    {
        
        $departments = Department::all();
        if ($request->filled('department_id') || $request->filled('keyword')) {
            $departments = Department::join('users', 'departments.user_id', '=', 'users.id')
                                    ->select('departments.id', 'departments.tower', 'departments.square_meters', 'departments.status',
                                    'users.name', 'users.phone_number',
                                    )
                                    ->where([
                                        ['departments.department_id', 'like', '%' . $request->department_id . '%'],
                                        ['users.phone_number', $request->keyword],
                                        ])
                                    ->orWhere([
                                        ['departments.department_id', 'like', '%' . $request->department_id . '%'],
                                        ['users.name', 'like', '%' . $request->keyword . '%'],
                                        ])
                                    ->get();
        }
        $departments->load('bills', 'users');
        return $this->success($departments);
    }
}

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
        if ($request->filled('floor')) {
            $departments = Department::where('floor', $request->floor)->get();
        }
        $result = DepartmentResource::collection($departments);
        return $this->success($result);
    }
}

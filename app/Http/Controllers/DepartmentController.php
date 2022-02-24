<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\BillDetail;
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

    public function getDepartmentInfo($id){
        $department = Department::join('users', 'departments.user_id', '=', 'users.id')
                                ->select('departments.*', 'users.name', 'users.avatar', 'users.phone_number', 'users.email')
                                ->where('departments.id', $id)
                                ->get();
        $department->load('users');
        return $this->success($department);
    }

    public function getBillByDepartmentId($id){
        $bill_by_department_id = Bill::join('departments', 'bills.department_id', '=', 'departments.id')
                                        ->join('bill_detail', 'bills.id', '=', 'bill_detail.bill_id')
                                        ->join('services', 'bill_detail.service_id', '=', 'services.id')
                                        ->select('bills.id', 'bills.name as ten_hoa_don', 'bills.department_id', 'bills.total', 'bills.status')
                                        ->distinct()
                                        ->where('departments.id', $id)
                                        ->get();
        return $this->success($bill_by_department_id);
    }

    public function getBillDetailByDepartmentId($id, $bill_id){
        $bill_detail_by_department_id = BillDetail::join('services', 'bill_detail.service_id', '=', 'services.id')
                                                    ->join('bills', 'bill_detail.bill_id', '=', 'bills.id')
                                                    ->join('departments', 'bills.department_id', '=', 'departments.id')
                                                    ->select('bill_detail.bill_id', 'bills.name as ten_hoa_don', 'services.name as ten_dich_vu', 'bill_detail.total_price', 'bills.department_id')
                                                    ->where('bill_detail.bill_id', $bill_id)
                                                    ->where('departments.id', $id)
                                                    ->get();
        return $this->success($bill_detail_by_department_id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Building;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDepartment(Request $request): JsonResponse
    {
        $departments = DepartmentResource::collection(Department::all());
        if ($request->filled('building_id') && $request->filled('keyword')) {
            $departments = Department::join('users', 'departments.id', '=', 'users.department_id')
                ->join('buildings', 'departments.building_id', '=', 'buildings.id')
                ->select(
                    'departments.department_id',
                    'departments.floor',
                    'departments.status',
                    'departments.description',
                    'departments.square_meters',
                    'departments.type_department',
                    'buildings.name as building_id',
                    'users.email',
                    'users.phone_number',
                    'users.name'
                )
                ->where([
                    ['departments.building_id', $request->building_id],
                    ['users.phone_number', $request->keyword],
                ])
                ->orWhere([
                    ['departments.building_id', $request->building_id],
                    ['users.email', 'like', '%' . $request->keyword . '%'],
                ])
                ->orWhere([
                    ['departments.building_id', $request->building_id],
                    ['users.name', 'like', '%' . $request->keyword . '%'],
                ])
                ->get();
        } elseif (!$request->filled('building_id') && $request->filled('keyword')) {
            $departments = Department::join('users', 'departments.id', '=', 'users.department_id')
                ->join('buildings', 'departments.building_id', '=', 'buildings.id')
                ->select(
                    'departments.department_id',
                    'departments.floor',
                    'departments.status',
                    'departments.description',
                    'departments.square_meters',
                    'departments.type_department',
                    'buildings.name as building_id',
                    'users.email',
                    'users.phone_number',
                    'users.name'
                )
                ->where('users.phone_number', $request->keyword)
                ->orWhere('users.email', 'like', '%' . $request->keyword . '%')
                ->orWhere('users.name', 'like', '%' . $request->keyword . '%')
                ->get();
        } elseif ($request->filled('building_id') && !$request->filled('keyword')) {
            $departments = DepartmentResource::collection(Department::where('building_id', $request->building_id)->get());
        }
        return $this->success($departments);
    }

    public function addForm()
    {
        $buildings = Building::all();
        return view('department.add', compact('buildings'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveAdd(Request $request): JsonResponse
    {
        $model = new Department();
        $model->fill($request->all());
        $model->save();
        return $this->success($model);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getDepartmentInfo($id): JsonResponse
    {
        $department = Department::join('users', 'departments.user_id', '=', 'users.id')
            ->select('departments.*', 'users.name', 'users.avatar', 'users.phone_number', 'users.email')
            ->where('departments.id', $id)
            ->get();
        $department->load('users');
        return $this->success($department);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getBillByDepartmentId($id): JsonResponse
    {
        $bill_by_department_id = Bill::join('departments', 'bills.department_id', '=', 'departments.id')
            ->join('bill_detail', 'bills.id', '=', 'bill_detail.bill_id')
            ->join('services', 'bill_detail.service_id', '=', 'services.id')
            ->select('bills.id', 'bills.name as ten_hoa_don', 'bills.department_id', 'bills.total', 'bills.status')
            ->distinct()
            ->where('departments.id', $id)
            ->get();
        return $this->success($bill_by_department_id);
    }

    /**
     * @param $id
     * @param $bill_id
     * @return JsonResponse
     */
    public function getBillDetailByDepartmentId($id, $bill_id): JsonResponse
    {
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

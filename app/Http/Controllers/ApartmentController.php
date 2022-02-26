<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentResource;
use App\Http\Resources\DepartmentResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Building;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function getApartment(Request $request): JsonResponse
    {
        $apartments = ApartmentResource::collection(Apartment::all());
        if ($request->filled('building_id') && $request->filled('keyword')) {
            $apartments = Apartment::join('users', 'apartments.id', '=', 'users.apartment_id')
                ->join('buildings', 'apartments.building_id', '=', 'buildings.id')
                ->select(
                    'apartments.apartment_id',
                    'apartments.floor',
                    'apartments.status',
                    'apartments.description',
                    'apartments.square_meters',
                    'apartments.type_apartment',
                    'buildings.name as building_id',
                    'users.email',
                    'users.phone_number',
                    'users.name'
                )
                ->where([
                    ['apartments.building_id', $request->building_id],
                    ['users.phone_number', $request->keyword],
                ])
                ->orWhere([
                    ['apartments.building_id', $request->building_id],
                    ['users.email', 'like', '%' . $request->keyword . '%'],
                ])
                ->orWhere([
                    ['apartments.building_id', $request->building_id],
                    ['users.name', 'like', '%' . $request->keyword . '%'],
                ])
                ->get();
        } elseif (!$request->filled('building_id') && $request->filled('keyword')) {
            $apartments = Apartment::join('users', 'apartments.id', '=', 'users.apartment_id')
                ->join('buildings', 'apartments.building_id', '=', 'buildings.id')
                ->select(
                    'apartments.apartment_id',
                    'apartments.floor',
                    'apartments.status',
                    'apartments.description',
                    'apartments.square_meters',
                    'apartments.type_apartment',
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
            $apartments = ApartmentResource::collection(Apartment::where('building_id', $request->building_id)->get());
        }
        return $this->success($apartments);
    }

    public function addForm()
    {
        $buildings = Building::all();
        return view('apartment.add', compact('buildings'));
    }

    public function saveAdd(Request $request)
    {
        $model = new Apartment();
        $model->fill($request->all());
        $model->save();
        return $this->success($model);
    }

    public function getApartmentInfo($id)
    {
        $department = Department::join('users', 'departments.user_id', '=', 'users.id')
            ->select('departments.*', 'users.name', 'users.avatar', 'users.phone_number', 'users.email')
            ->where('departments.id', $id)
            ->get();
        $department->load('users');
        return $this->success($department);
    }

    public function getBillByApartmentId($id)
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

    public function getBillDetailByApartmentId($id, $bill_id)
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

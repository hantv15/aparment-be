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
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getApartment(Request $request): JsonResponse
    {
        $apartments = ApartmentResource::collection(Apartment::all());
        if ($request->filled('building_id') && $request->filled('keyword')) {
            $apartments = Apartment::join('users', 'apartments.id', '=', 'users.apartment_id')
                ->join('buildings', 'apartments.building_id', '=', 'buildings.id')
                ->select(
                    'apartments.id',
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
        } else if (! $request->filled('building_id') && $request->filled('keyword')) {
            $apartments = Apartment::join('users', 'apartments.id', '=', 'users.apartment_id')
                ->join('buildings', 'apartments.building_id', '=', 'buildings.id')
                ->select(
                    'apartments.id',
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
        } else if ($request->filled('building_id') && ! $request->filled('keyword')) {
            $apartments = ApartmentResource::collection(Apartment::where('building_id', $request->building_id)->get());
        }

        return $this->success($apartments);
    }

    public function addForm()
    {
        $buildings = Building::all();

        return view('apartment.add', compact('buildings'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveAdd(Request $request): JsonResponse
    {
        $model = new Apartment();
        $model->fill($request->all());
        $model->save();

        return $this->success($model);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getApartmentInfo($id): JsonResponse
    {
        $apartment = Apartment::join('users', 'apartments.id', '=', 'users.apartment_id')
            ->join('buildings', 'apartments.building_id', '=', 'buildings.id')
            ->select(
                'apartments.apartment_id',
                'users.phone_number',
                'buildings.name as building_name',
                'apartments.square_meters',
                'apartments.status',
                'users.name',
                'users.avatar'
            )
            ->where('apartments.id', $id)
            ->get();

        return $this->success($apartment);
    }

    /**
     * Get bill by apartment id
     *
     * @param $id
     * @return JsonResponse
     */
    public function getBillByApartmentId($id): JsonResponse
    {
        $bill_by_department_id = Bill::join('departments', 'b ills.department_id', '=', 'departments.id')
            ->join('bill_detail', 'bills.id', '=', 'bill_detail.bill_id')
            ->join('services', 'bill_detail.service_id', '=', 'services.id')
            ->select('bills.id', 'bills.name as ten_hoa_don', 'bills.department_id', 'bills.total', 'bills.status')
            ->distinct()
            ->where('departments.id', $id)
            ->get();

        return $this->success($bill_by_department_id);
    }

    /**
     * Get build detail by apartment ID
     *
     * @param $id
     * @param $bill_id
     * @return JsonResponse
     */
    public function getBillDetailByApartmentId($id, $bill_id): JsonResponse
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

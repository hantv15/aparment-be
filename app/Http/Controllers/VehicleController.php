<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleEditRequest;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Apartment;
use App\Models\Card;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function getVehicle()
    {
        $vehicles = Vehicle::all();
        $vehicles->load('category');
        return view('vehicles.index', compact('vehicles'));
    }

    public function addForm()
    {
        $vehicle_types = VehicleType::all();

        $apartment = Apartment::all();
        return view('vehicles.add', compact('vehicle_types', 'apartment'));
    }

    public function saveAdd(VehicleRequest $request)
    {
        $count = Apartment::join('vehicles', 'apartments.id', 'vehicles.apartment_id')
            ->join('vehicle_types', 'vehicles.vehicle_type_id', 'vehicle_types.id')
            ->where('vehicles.apartment_id', $request->apartment_id)
            ->where('vehicles.vehicle_type_id', $request->vehicle_type_id)
            ->count();
        $checksl = Apartment::join('vehicles', 'apartments.id', 'vehicles.apartment_id')
            ->join('vehicle_types', 'vehicles.vehicle_type_id', 'vehicle_types.id')
            ->where('apartments.id', $request->apartment_id)
            ->where('vehicle_types.id', $request->vehicle_type_id)
            ->select('sl')
            ->first();

        // dd($checksl->sl);
        if ($checksl) {
            if ($count >=  $checksl->sl) {
                return redirect(route('vehicle.add'))->with('msg', 'Phương tiên của sở hữu của căn hộ đã đạt mức tối đa');
            } else {
                $vehicle = new Vehicle();
                $vehicle->fill($request->all());
                $vehicle->save();
                return redirect(route('vehicle.index'));
            }
        }
        $vehicle = new Vehicle();
        $vehicle->fill($request->all());
        $vehicle->save();
        return redirect(route('vehicle.index'));
    }
    public function editForm($id)
    {
        $vehicle_types = VehicleType::all();
        $vehicle = Vehicle::find($id);
        return view('vehicles.edit', compact('vehicle', 'vehicle_types'));
    }
    public function saveEdit(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'plate_number' => [
                    'required', 'string',
                    // Rule::unique('vehicles')->ignore($id)
                ],
                'vehicle_type_id' => 'required|integer'
            ],
            [
                'plate_number.required' => 'Biển số xe Không được trống',
                'plate_number.string' => 'Biển số xe phải là chuỗi',
                // 'plate_number.unique' => 'Biển số xe đã tồn tại',
                'vehicle_type_id.required' => 'Loại phương tiện không được trống',
                'vehicle_type_id.integer' => 'Loại phương tiện không đúng định dạng',

            ]
        );
       
        $vehicle = Vehicle::find($id);
        $vehicle->fill($request->all());
        $vehicle->save();
        return redirect(route('vehicle.index'));
    }
     public function remove($id){
         $model= Vehicle::find($id);
         $model->delete();
         return redirect(route('vehicle.index'));
     }
}

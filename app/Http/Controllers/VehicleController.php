<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleEditRequest;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
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
        
        return view('vehicles.index',compact('vehicles'));
    }

    public function addForm(){
        $vehicle_types = VehicleType::all();
        $cards = Card::all();
        return view('vehicles.add', compact('vehicle_types', 'cards'));
    }

    public function saveAdd(VehicleRequest $request)
    {
      
        
        
     
   
        
        $vehicle = new Vehicle();
        $vehicle->fill($request->all());
        $vehicle->save();
        return redirect(route('vehicle.index'));
    }
    public function editForm($id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicle.edit', compact('vehicle'));
    }
    public function saveEdit(Request $request, $id):JsonResponse
    {       
        $validator = Validator::make($request->all(),
        ['plate_number' => [
            'required', 'string',
            Rule::unique('vehicles')->ignore($id)
        ],
        'vehicle_type_id'=>'required|integer'],
        [
            'plate_number.required'=> 'Biển số xe Không được trống',
            'plate_number.string'=> 'Biển số xe phải là chuỗi',
            'plate_number.unique'=>'Biển số xe đã tồn tại',
            'vehicle_type_id.required'=>'Loại phương tiện không được trống',
            'vehicle_type_id.integer'=>'Loại phương tiện không đúng định dạng',

        ]
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        $vehicle = Vehicle::find($id);
        $vehicle->fill($request->all());
        $vehicle->save();
        return $this->success($vehicle);
    }
}

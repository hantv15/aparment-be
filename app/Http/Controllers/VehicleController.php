<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleEditRequest;
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
    public function getVehicle():JsonResponse
    {
        $vehicles = Vehicle::all();
        $result = VehicleResource::collection($vehicles);
        return $this->success($result);
    }

    public function addForm(){
        $vehicle_types = VehicleType::all();
        $cards = Card::all();
        return view('vehicle.add', compact('vehicle_types', 'cards'));
    }

    public function saveAdd(Request $request): JsonResponse
    {
        $twostr = substr($request->plate_number,0,2);
        $inttwostr = (int)$twostr;
        if($inttwostr <= 10 || $inttwostr == 13){
            return $this->failed($inttwostr.' '.'là biển số xe không có trong tỉnh nào');
        }
        
        
        $validator = Validator::make($request->all(),
        ['plate_number' => 'required|string|regex:/^(?!0|1|2|3|$|%|67}8}9|13)[0-9]{2}[A-Z]{1}-[0-9]{4,5}$/',
        'vehicle_type_id'=>'required|integer'
        ],
        [
            'plate_number.required'=> 'Biển số Không được trống',
            'plate_number.string'=> 'Biển số phải là chuỗi',
            'vehicle_type_id.required'=>'Loại xe không được trống',
            'vehicle_type_id.integer'=> 'Loại xe không đúng định dạng'
        ] 
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        
        $vehicle = new Vehicle();
        $vehicle->fill($request->all());
        $vehicle->save();
        return $this->success($vehicle);
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
            'vehicle_type_id.required'=>'Loại xe không được trống',
            'vehicle_type_id.integer'=>'Loại xe không đúng định dạng',

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

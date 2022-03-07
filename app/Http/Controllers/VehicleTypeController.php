<?php

namespace App\Http\Controllers;

use App\Http\Resources\VehicleTypeResource;
use App\Models\VehicleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function getVehicleType():JsonResponse
    {
        $vehicle_types = VehicleType::all();
        $result = VehicleTypeResource::collection($vehicle_types);
        return $this->success($result);
    }

    public function addForm(){
        return view('vehicle-type.add');
    }

    public function saveAdd(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|unique:vehicle_types',
            'price' => 'required|min:0',
        ]);
        $vehicle_type = new VehicleType();
        $vehicle_type->fill($request->all());
        $vehicle_type->save();
        return $this->success($vehicle_type);
    }
}

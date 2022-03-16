<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleEditRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Card;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $request->validate([
            'plate_number' => 'required|string|unique:vehicles',
            'vehicle_type_id' => 'required',
            'card_id' => 'required'
        ]);
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
    public function saveEdit(VehicleEditRequest $request, $id):JsonResponse
    {       
        $vehicle = Vehicle::find($id);
        $vehicle->fill($request->all());
        $vehicle->save();
        return $this->success($vehicle);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleTypeRequest;
use App\Http\Resources\VehicleTypeResource;
use App\Models\VehicleType;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleTypeController extends Controller
{
    public function getVehicleType()
    {
        $vehicle_types = VehicleType::all();
     
        return view('vehicle-type.index',compact('vehicle_types'));
    }

    public function addForm(){
        return view('vehicle-type.add');
    }

    public function saveAdd(VehicleTypeRequest  $request)
    {
        $vehicle_type = new VehicleType();
        $vehicle_type->fill($request->all());
        $vehicle_type->save();
        return redirect(route('vehicle-type.index'));
    }
   
    public function editForm($id){
        $model = VehicleType::find($id);
        return view('vehicle-type.edit',compact('model'));
    }
    public function saveEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        ['name' => [
            'required', 'string',
            Rule::unique('vehicle_types')->ignore($id)
        ],
        
        'price' => 'required|integer|min:1',],
        [
            'name.required'=> 'Tên Không được trống',
            'name.string'=> 'Tên phải là chuỗi',
            'name.unique'=>'Tên đã tồn tại',
            'name.regex'=>'Tên không được chứa kí tự đặc biệt, số và phải là chữ',
            'price.required'=>'Phí không được trống',
            'price.integer'=>'Phí phải là số',
            'price.min'=>'Phí nhỏ nhất là 1'

        ]
    );
    
        
        $vehicle_type = VehicleType::find($id);
        $vehicle_type->fill($request->all());
        $vehicle_type->save();
        return redirect(route('vehicle-type.index'));
    }
}

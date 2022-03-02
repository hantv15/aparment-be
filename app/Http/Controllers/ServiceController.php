<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getService(): JsonResponse
    {
        $services = Service::all();
        $result = ServiceResource::collection($services);
        return $this->success($result);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addForm(){
        return view('service.add');
    }
    public function saveAdd(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|unique:services',
            'price' => 'required|integer|min:0',
            
            
        ]);
        $service = new Service();
        $service->fill($request->all());
        $service->save();
        return $this->success($service);
    }
    public function editForm($id): JsonResponse
    {
        $service = Service::find($id);
        
        return $this->success($service);
        
    }
    public function saveEdit(Request $request,$id): JsonResponse
    {   
        
        $service = Service::find($id);
        if($request->name == $service->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required|integer|min:0',
            ]);
            
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:services',
                'price' => 'required|integer|min:0',
            ]);
            
        }
        if($validator->fails()){
            return $this->failed();
        }
        
        $service->fill($request->all());
        $service->save();
        return $this->success($service,'successfully');
    }
    public function getServiceById($id):JsonResponse
    {
        $service = Service::find($id);
        return $this->success($service);
    }
    
}

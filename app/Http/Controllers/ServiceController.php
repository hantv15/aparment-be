<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function addService(Request $request): JsonResponse
    {
        $service = new Service();
        $service->fill($request->all());
        $service->save();
        return $this->success($service);
    }
    public function editService($id): JsonResponse
    {
        $service = Service::find($id);
        
        return $this->success($service);
    }
    public function saveEditService(Request $request,$id): JsonResponse
    {
        $service = Service::find($id);
        $service->fill($request->all());
        $service->save();
        return $this->success($service);
    }
    public function removeService($id)
    {
        $service = Service::find($id);
       
        $service->delete();
        return $this->success($service);
    }
    
}

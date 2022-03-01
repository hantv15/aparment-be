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

    public function addForm(){
        return view('service.add');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveAdd(Request $request): JsonResponse
    {
        $service = new Service();
        $service->fill($request->all());
        $service->save();

        return $this->success($service);
    }
}

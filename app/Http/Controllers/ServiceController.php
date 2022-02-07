<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getService(): JsonResponse
    {
        $services = Service::all();
        $result = ServiceResource::collection($services);
        return $this->success($result, 'Danh sach dich vu');
    }

    public function addService(Request $request): JsonResponse
    {
        $service = new Service();
        $service->fill($request->all());
        $service->save();
        
        return $this->success($service, 'Them dich vu thanh cong');
    }
}

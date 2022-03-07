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
    public function getService(Request $request): JsonResponse
    {
        $services = Service::all();

        if($request->filled('price') && $request->price == 1){
            $services= $services->sortByDesc('price');
        }
        elseif($request->filled('price') && $request->price == 2){
            $services= $services->sortBy('price');
        }
        if ($request->filled('page') && $request->filled('page_size')){
            $services = $services->skip( ($request->page-1) * $request->page_size )->take($request->page_size);
        }
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
            'price' => 'required|min:0',
        ]);
        $service = new Service();
        $service->fill($request->all());
        $service->save();
        $result = ServiceResource::collection($service);
        return $this->success($result);
    }

    public function editForm($id)
    {
        $service = Service::find($id);
        return view('service.edit', compact('service'));
    }

    public function saveEdit(Request $request,$id): JsonResponse
    {

        $service = Service::find($id);
        if($request->name == $service->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required|min:0',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:services',
                'price' => 'required|min:0',
            ]);
        }
        if($validator->fails()){
            return $this->failed();
        }
        $service->fill($request->all());
        $service->save();
        $result = ServiceResource::collection($service);
        return $this->success($result);
    }
    public function getServiceById($id):JsonResponse
    {
        $service = Service::find($id);
        if (!$service) {
            return $this->failed();
        }
        $result = ServiceResource::collection($service);
        return $this->success($result);
    }

}

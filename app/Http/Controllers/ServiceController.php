<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
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
        if($request->filled('keyword')){
            $services = Service::where('name','like','%' . $request->keyword . '%')
                                ->orWhere('price',  $request->keyword)
                                ->get();
        }
        if( $request->filled('sort') && $request->sort == 1){
            $services= $services->sortByDesc('price');
        }
        elseif(  $request->filled('sort') && $request->sort == 2){
            $services= $services->sortBy('price');
        }elseif(  $request->filled('sort') && $request->sort == 3){
            $services= $services->sortBy('name');
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
        $service = new Service();
        $service->fill($request->all());
        $service->save();
        return $this->success($service);
    }

    public function editForm($id)
    {
        $service = Service::find($id);
        return view('service.edit', compact('service'));
    }

    public function saveEdit(ServiceRequest $request,$id): JsonResponse
    {

        $service = Service::find($id);
        if (!$service) {
            return $this->failed();
        }
        $service->fill($request->all());
        $service->save();
        return $this->success($service);
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

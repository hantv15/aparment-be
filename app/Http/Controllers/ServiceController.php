<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function getService(Request $request)
    {
        $services = Service::paginate(10);
        if($request->filled('keyword')){
            $services = Service::where('name','like','%' . $request->keyword . '%')
                                ->orWhere('price',  $request->keyword)
                                ->get();
        }
        if($request->filled('sort') && $request->sort == 1){
            $services= $services->sortByDesc('price');
        }
        elseif ($request->filled('sort') && $request->sort == 2){
            $services= $services->sortBy('price');
        }elseif($request->filled('sort') && $request->sort == 3){
            $services= $services->sortBy('name');
        }
        if ($request->filled('page') && $request->filled('page_size')){
            $services = $services->skip( ($request->page-1) * $request->page_size )->take($request->page_size);
        }
        return view('services.index', compact('services'));
    }

    public function addForm(){
        return view('services.add');
    }

    public function saveAdd(Request $request)
    {
        $validator = Validator::make($request->all(),
        ['name' => 'required|string|unique:services|regex:/[a-zA-Z]/',
        'price'=>'required|integer|min:1',
        'icon' => 'nullable|image',
        ],
        [
            'name.required'=> 'Tên số Không được trống',
            'name.string'=> 'Tên phải là chuỗi',
            'name.unique'=> 'Tên đã tồn tại',
            'name.regex'=> 'Tên không được chứa ki tự đặc biệt hoặc số',
            'price.required'=> 'Phí Không được trống',
            'price.integer'=>'Phí phải là số',
            'price.min'=> 'Phí không được nhỏ hơn 1',
            'icon.image'=> 'Icon phải là định dạng ảnh',
        ]
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        $service = new Service();
        $service->fill($request->all());
        $service->save();
        return redirect(route('service.index'));
    }

    public function editForm($id)
    {
        $service = Service::find($id);
        return view('services.edit', compact('service'));
    }

    public function saveEdit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
        ['name' => [
            'required', 'string','regex:/[a-zA-Z]/',
            Rule::unique('services')->ignore($id)
        ],
        'price'=>'required|integer|min:1',
        'icon' => 'nullable|image',
        'description' =>  'required', 'string','regex:/[a-zA-Z]/',
        Rule::unique('services')->ignore($id),
        ],
        [
            'name.required'=> 'Tên số Không được trống',
            'name.required'=> 'Tên phải la chuỗi',
            'name.regex'=> 'Tên không được chứa kí tự đặc biêt hoặc sô',
            'price.required'=> 'Phí Không được trống',
            'price.integer'=>'Phí phải là số',
            'price.min'=> 'Phí không được nhỏ hơn 1',
            'icon.image'=> 'Icon phải là định dạng ảnh',
        ]
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        $service = Service::find($id);
        if (!$service) {
            return $this->failed();
        }
        $service->fill($request->all());
        $service->save();
        return redirect(route('service.index'));
    }
    public function getServiceById($id):JsonResponse
    {
        $service = Service::find($id);
        if (!$service) {
            return $this->failed();
        }

        return $this->success($service);
    }

}

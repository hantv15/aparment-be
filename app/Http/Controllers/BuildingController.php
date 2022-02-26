<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getBuilding(): JsonResponse
    {
        $buildings = Building::all();
        $result = BuildingResource::collection($buildings);
        return $this->success($result);
    }

    /**
     * @return Application|Factory|View
     */
    public function addForm()
    {
        return view('building.add');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveAdd(Request $request): JsonResponse
    {
        $model = new Building();
        $model->fill($request->all());
        $model->save();
        return $this->success($model);
    }
}

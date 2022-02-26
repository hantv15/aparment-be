<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    public function getBuilding(): JsonResponse
    {
        $buildings = Building::all();
        $result = BuildingResource::collection($buildings);
        return $this->success($result);
    }

    public function addForm()
    {
        return view('building.add');
    }

    public function saveAdd(Request $request): JsonResponse
    {
        $model = new Building();
        $model->fill($request->all());
        $model->save();
        return $this->success($model);
    }
}

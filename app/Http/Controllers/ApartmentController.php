<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function getApartment(Request $request): JsonResponse
    {
        if (!$request->floor){
            $apartments = Apartment::all();
            $result = ApartmentResource::collection($apartments);
            return $this->success($result, 'Danh sach can ho');
        }
        else {
            $apartments = Apartment::where('floor', '=', $request->floor)->get();
            $result = ApartmentResource::collection($apartments);
            return $this->success($result, 'Danh sach can ho theo tang');
        }
    }
}

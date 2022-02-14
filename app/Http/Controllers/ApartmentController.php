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

        $apartments = Apartment::all();
        if ($request->filled('floor')) {
            $apartments = Apartment::where('floor', $request->floor)->get();
        }
        $result = ApartmentResource::collection($apartments);
        return $this->success($result);
    }
}

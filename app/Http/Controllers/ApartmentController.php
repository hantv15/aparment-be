<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function getApartment(): JsonResponse
    {
        $apartments = Apartment::all();
        $result = ApartmentResource::collection($apartments);

        return $this->success($result);
    }
}

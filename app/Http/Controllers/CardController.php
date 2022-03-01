<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function getCard():JsonResponse
    {
        $cards = Card::all();
        $result = CardResource::collection($cards);
        return $this->success($result);
    }

    public function getCardByApartmentId($id):JsonResponse
    {
        $cards = Card::where('apartment_id', $id)->get();
        $result = CardResource::collection($cards);
        return $this->success($result);
    }
}

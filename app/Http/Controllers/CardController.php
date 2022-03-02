<?php

namespace App\Http\Controllers;

use App\Http\Resources\CardResource;
use App\Models\Apartment;
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

    public function addForm(){
        $apartments = Apartment::all();
        return view('card.add',compact('apartments'));
    }

    public function saveAdd(Request $request):JsonResponse
    {
        $card = new Card();
        $card->fill($request->all());
        $card->save();
        return $this->success($card);
    }

    public function editForm($id)
    {
        $card = Card::find($id);
        $year = substr($card->expire_time, 0, 4);
        $month = substr($card->expire_time, 5, 2);
        $day = substr($card->expire_time, 8, 2);
        $hour = substr($card->expire_time, 11, 2);
        $minute = substr($card->expire_time, 14, 2);
        $apartments = Apartment::all();
        return view('card.edit', compact('card', 'apartments', 'year', 'month', 'day', 'hour', 'minute'));
    }

    public function saveEdit(Request $request,$id):JsonResponse
    {
        $card =Card::find($id);
        $card->fill($request->all());
        $card->save();
        return $this->success($card);
    }

    public function remove($id):JsonResponse
    {
        $card =Card::find($id);
        $card->delete();
        return $this->success($card);
    }
}

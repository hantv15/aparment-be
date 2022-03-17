<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Http\Resources\CardResource;
use App\Models\Apartment;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function getCard(Request $request):JsonResponse
    {
        $cards = Card::all();
        if($request->filled('keyword')){
            $cards = Card::where('name','like','%' . $request->keyword . '%')->get();
        }
        if($request->filled('sort') && $request->sort == 1){
            $cards= $cards->sortByDesc('name');
        }
        elseif($request->filled('sort') && $request->sort == 2){
            $cards= $cards->sortBy('name');
        }
        if ($request->filled('page') && $request->filled('page_size')){
            $cards = $cards->skip( ($request->page-1) * $request->page_size )->take($request->page_size);
        }
        $result = CardResource::collection($cards);
        return $this->success($result);
    }

    public function getCardByApartmentId($id): JsonResponse
    {
        $cards = Card::select(
                        'cards.id',
                        'cards.number',
                        'cards.name',
                        'cards.status',
                        'cards.expire_time'
                    )
                    ->withCount('vehicles as so_luong_phuong_tien')
                    ->where('apartment_id', $id)
                    ->get();
        return $this->success($cards);
    }

    public function addForm(){
        $apartments = Apartment::all();
        return view('card.add',compact('apartments'));
    }

    public function saveAdd(CardRequest $request):JsonResponse
    {
        $number = rand(100000000, 999999999);
        $count_exist_number = Card::where('number', $number)->count();
        while ($count_exist_number > 0) {
            $number = rand(100000000, 999999999);
            $count_exist_number = Card::where('number', $number)->count();
        }

        $count_card_by_apartment_id = Card::where('apartment_id', $request->apartment_id)->count();
        //Giới hạn mỗi phòng chỉ có tối đa 5 thẻ
        if ($count_card_by_apartment_id > 4){
            return $this->failed();
        }

        $card = new Card();
        $card->fill($request->all());
        $card->number = $number;
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

    public function saveEdit(CardRequest $request, $id): JsonResponse
    {
        $card =Card::find($id);
        $card->fill($request->all());
        $card->save();
        return $this->success($card);
    }

    public function getCardById($id)
    {
        $card =Card::where('id',$id)->get();
        if (!$card) {
            return $this->failed();
        }
        return $this->success($card);
    }
}

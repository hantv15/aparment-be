<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillResource;
use App\Http\Resources\ServiceResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function getBill(): JsonResponse
    {
        $bills = Bill::all();
        $result = BillResource::collection($bills);
        return $this->success($result);
    }

    public function addForm(){
        $apartments = Apartment::all();
        return view('bill.add', compact('apartments'));
    }

    public function saveAdd(Request $request):JsonResponse
    {
        $bill = new Bill();
        $bill->fill($request->all());
        $bill->save();
        return $this->success(BillResource::collection(Bill::where('id', $bill->id)->get()));
    }

    public function editForm($id){
        $bill = Bill::where('id', $id)->first();
        return view('bill.edit', compact('bill'));
    }

    public function saveEdit($id, Request $request):JsonResponse
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }
        $bill->fill($request->all());
        $bill->save();

        return $this->success($bill);
    }

    public function getBillById($id): JsonResponse
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }

        return $this->success($bill);
    }
}

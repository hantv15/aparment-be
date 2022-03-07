<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillResource;
use App\Http\Resources\ServiceResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;

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
        $bill = Bill::find($id);
        if ($bill->status == 1){
            return $this->failed();
        }
        $bill->load('apartment', 'services');
        return view('bill.edit', compact('bill'));
    }

    public function saveEdit($id, Request $request):JsonResponse
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }
        if ($bill->status == 1){
            return $this->failed();
        }
        $bill->fill($request->all());
        $bill->save();

        return $this->success($bill);
    }

    public function editAddBillDetailForm($id){
        $bill = Bill::find($id);
        $services = Service::all();
        if ($bill->status == 1){
            return $this->failed();
        }
        return view('bill.edit-add-bill-detail', compact('bill', 'services'));
    }

    public function saveEditAddBillDetail($id, Request $request){
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }
        if ($bill->status == 1){
            return $this->failed();
        }
        $bill_detail = new BillDetail();
        $bill_detail->fill($request->all());
        $bill_detail->bill_id = $bill->id;
        $bill_detail->total_price = $request->quantity * Service::where('id', $request->service_id)->first()->price;
        if ($request->service_id == Service::WATER_SERVICE) {
            if ($request->quantity <= 10) {
                $bill_detail->total_price = $request->quantity * 5973;
            } elseif ($request->quantity <= 20) {
                $bill_detail->total_price = 10 * 5973 + ($request->quantity - 10) * 7052;
            } elseif ($request->quantity <= 30) {
                $bill_detail->total_price = 10 * 5973 + 10 * 7052 + ($request->quantity - 20) * 8669;
            } elseif ($request->quantity > 30) {
                $bill_detail->total_price = 10 * 5973 + 10 * 7052 + 10 * 8669 + ($request->quantity - 30) * 15929;
            }
        }
        $bill_detail->save();

        $bill = Bill::where('id', $bill->id)->first();
        $bill->amount += $bill_detail->total_price;
        $bill->save();

        return $this->success($bill);
    }

    public function editStatusForm($id){
        $bill = Bill::find($id);
        $bill->load('apartment');
        return view('bill.edit-status', compact('bill'));
    }

    public function saveEditStatus($id, Request $request):JsonResponse
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }
        $bill->status = $request->status;
        $bill->save();

        return $this->success($bill);
    }

    public function getBillById($id): JsonResponse
    {
        $bill = Bill::leftJoin('bill_details', 'bills.id', '=', 'bill_details.bill_id')
            ->leftJoin('services', 'bill_details.service_id', '=', 'services.id')
            ->select(
                'bills.id',
                'bills.name as ten_hoa_don',
                'bills.amount',
                'bills.status',
                'bills.apartment_id',
                'bill_details.quantity',
                'services.price',
                'bill_details.total_price',
                'services.name as ten_dich_vu'

            )
            ->where('bills.id', $id)
            ->get();
        if (!$bill) {
            return $this->failed();
        }

        return $this->success($bill);
    }
}

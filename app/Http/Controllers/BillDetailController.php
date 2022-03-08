<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getBillDetail(): JsonResponse
    {
        $bill_details = BillDetail::all();
        return $this->success($bill_details);
    }

    public function addForm()
    {
        $services = Service::all();
        $bills = Bill::all();
        return view('bill-detail.add', compact('services', 'bills'));
    }

    public function saveAdd(Request $request): JsonResponse
    {
        $bill_detail = new BillDetail();
        $bill_detail->fill($request->all());
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

        $bill = Bill::where('id', $request->bill_id)->first();
        $bill->amount += $bill_detail->total_price;
        $bill->save();

        return $this->success($bill_detail);
    }

    public function editForm($id){
        $bill_detail = BillDetail::find($id);
        $services = Service::all();
        $bills = Bill::where('status', 0)->get();
        return view('bill-detail.edit', compact('bill_detail', 'services', 'bills'));
    }

    public function saveEdit($id, Request $request):JsonResponse
    {
        $bill_detail = BillDetail::find($id);
        if (Bill::find($bill_detail->bill_id)->status != 0){
            return $this->failed();
        }
        if (Bill::find($request->bill_id)->status != 0){
            return $this->failed();
        }
        $old_service_id = $bill_detail->service_id;
        $old_bill_id = $bill_detail->bill_id;
        $old_quantity = $bill_detail->quantity;
        $old_total_price = $bill_detail->total_price;

        $old_amount_by_old_bill_id = Bill::find($old_bill_id)->amount;
        $new_amount_by_old_bill_id = $old_amount_by_old_bill_id - $old_total_price;

        $bill_detail->fill($request->all());
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

        $bill_from = Bill::where('id', $old_bill_id)->first();
        $bill_from->amount = $new_amount_by_old_bill_id;
        $bill_from->save();

        $bill_to = Bill::where('id', $request->bill_id)->first();
        $bill_to->amount += $bill_detail->total_price;
        $bill_to->save();

        return $this->success($bill_detail);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getBillDetailById($id): JsonResponse
    {
        $bill_detail = BillDetail::find($id);
        return $this->success($bill_detail);
    }
}

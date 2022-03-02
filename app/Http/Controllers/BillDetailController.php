<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Department;
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
        $bill_detail->save();

        $bill = Bill::where('id', $request->bill_id)->first();
        $bill->amount += $bill_detail->total_price;
        $bill->save();

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
    public function editForm($id): JsonResponse
    {
        $bill_detail = BillDetail::find($id);
        return $this->success($bill_detail);
    }
    public function saveEdit(Request $request, $id): JsonResponse
    {
        $bill_detail = BillDetail::find($id);
        $bill_detail->fill($request->all());
        $bill_detail->save();
        return $this->success($bill_detail);
    }
}

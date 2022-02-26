<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Department;
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

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getBillDetailById($id): JsonResponse
    {
        $bill_detail = BillDetail::find($id);
        $bill_detail->load('bill');
        return $this->success($bill_detail);
    }
}

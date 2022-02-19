<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Department;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    public function getBillDetail(){
        $bill_details = BillDetail::all();
        return $this->success($bill_details);
    }

    public function getBillDetailById($id){
        $bill_detail = BillDetail::find($id);
        $bill_detail->load('bill');
        return $this->success($bill_detail);
    }
}

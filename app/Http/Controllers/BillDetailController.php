<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillDetailController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getBillDetail()
    {
        $bill_details = BillDetail::all();
        return view('bill-detail.index',compact($bill_details));
    }

    public function addForm()
    {
        $services = Service::all();
        $bills = Bill::where('status', 0)->get();
        // var_dump(json_decode($bills));die;
        return view('bill-details.add', compact('services', 'bills'));
    }

    public function saveAdd(Request $request)
    {   
        $validator = Validator::make($request->all(),
        [
            'service_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'bill_id' => 'required|integer'
        ],
        [
            'service_id.required' => 'Dịch vụ số Không được trống',
            'service_id.integer' => 'Dịch vụ không đúng định dạng',
            // 'service_id.exists' => 'Dịch vụ không có',
            'quantity.required' => 'Số lượng không được trống',
            'quantity.integer' => 'Số phải là số',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1',
            'bill_id.required' => 'Hóa Đơn không được trống',
            'bill_id.integer' => 'Hóa Đơn không đúng định dạng',
            'bill_id.exists' => 'Hóa Đơn không có',

        ]
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        $bill_detail = new BillDetail();
        // $count_service_in_bill = BillDetail::where('bill_id', $request->bill_id)
        //                             ->where('service_id', $request->service_id)
        //                             ->count();
        // if ($count_service_in_bill > 0) {
        //     return 1;
        //  return lỗi
        // }
        $bill_detail->fill($request->all());
        $category_service = Service::where('id',$request->service_id)->first()->category;
        if( $category_service ==1 ){
            $bill_detail->total_price = $request->quantity * Service::where('id', $request->service_id)->first()->price;
        }elseif($category_service ==3){
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
        // $bill_detail->total_price = $request->quantity * Service::where('id', $request->service_id)->first()->price;
        // if ($request->service_id == Service::WATER_SERVICE) {
        //     if ($request->quantity <= 10) {
        //         $bill_detail->total_price = $request->quantity * 5973;
        //     } elseif ($request->quantity <= 20) {
        //         $bill_detail->total_price = 10 * 5973 + ($request->quantity - 10) * 7052;
        //     } elseif ($request->quantity <= 30) {
        //         $bill_detail->total_price = 10 * 5973 + 10 * 7052 + ($request->quantity - 20) * 8669;
        //     } elseif ($request->quantity > 30) {
        //         $bill_detail->total_price = 10 * 5973 + 10 * 7052 + 10 * 8669 + ($request->quantity - 30) * 15929;
        //     }
        // }
        $bill_detail->save();

        $bill = Bill::where('id', $request->bill_id)->first();
        $bill->amount += $bill_detail->total_price;
        $bill->save();
        return redirect(round('apartment'));
        // return $this->success($bill_detail);
    }

    public function editForm($id){
        $bill_detail = BillDetail::find($id);
        $services = Service::all();
        $bills = Bill::where('status', 0)->get();
        return view('bill-detail.edit', compact('bill_detail', 'services', 'bills'));
    }

    public function saveEdit($id, Request $request):JsonResponse
    {   
        $validator = Validator::make($request->all(),
        [
            'service_id' => 'required|integer|exists:services',
            'quantity' => 'required|integer|min:1',
            'bill_id' => 'required|integer|exists:bills'
        ],
        [
            'service_id.required' => 'Dịch vụ số Không được trống',
            'service_id.integer' => 'Dịch vụ không đúng định dạng',
            'service_id.exists' => 'Dịch vụ không có',
            'quantity.required' => 'Số lượng không được trống',
            'quantity.integer' => 'Số phải là số',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1',
            'bill_id.required' => 'Hóa Đơn không được trống',
            'bill_id.integer' => 'Hóa Đơn không đúng định dạng',
            'bill_id.exists' => 'Hóa Đơn không có',

        ]
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        $bill_detail = BillDetail::find($id);
        $count_service_in_bill = BillDetail::where('bill_id', $request->bill_id)
                                        ->where('service_id', $request->service_id)
                                        ->whereNotIn('service_id', [$bill_detail->service_id])
                                        ->count();
        if ($count_service_in_bill > 0) {
            return $this->failed();
        }

        $old_total_price = $bill_detail->total_price;

        $old_amount = Bill::where('id', $bill_detail->bill_id)->first()->amount;
        $new_amount = $old_amount - $old_total_price;

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

        $bill = Bill::where('id', $bill_detail->bill_id)->first();
        $bill->amount = $new_amount + $bill_detail->total_price;
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
}

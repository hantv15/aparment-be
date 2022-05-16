<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillDetailRequest;
use App\Http\Requests\BillRequest;
use App\Http\Resources\BillResource;
use App\Models\Apartment;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Building;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

use function Ramsey\Uuid\v1;
use function Sodium\compare;

class BillController extends Controller
{
    public function getBill(Request $request)
    {
        $bills = Bill::all();
        if ($request->filled('keyword')) {
            $bills = Bill::where('name', 'like', '%' . $request->keyword . '%')->get();
        }
        if ($request->filled('page') && $request->filled('page_size')) {
            $bills = $bills->skip(($request->page - 1) * $request->page_size)->take($request->page_size);
        }
        return view('bills.index', compact('bills'));
    }

    public function getUnpaidBill(Request $request) {
        $unpaid_bills = Bill::where('status', 0)->get();
        if ($request->filled('page') && $request->filled('page_size')) {
            $unpaid_bills = $unpaid_bills->skip(($request->page - 1) * $request->page_size)->take($request->page_size);
        }
        return view('bills.list-unpaid', compact('unpaid_bills'));
    }

    public function getPaidBill(Request $request) {
        $paid_bills = Bill::where('status', 1)->get();
        if ($request->filled('page') && $request->filled('page_size')) {
            $paid_bills = $paid_bills->skip(($request->page - 1) * $request->page_size)->take($request->page_size);
        }
        return view('bills.list-paid', compact('paid_bills'));
    }

    public function addForm()
    {
        $apartments = Apartment::all();
        return view('bills.add', compact('apartments'));
    }

    public function saveAdd(BillRequest $request)
    {
        dd($request->all());
        $bill = new Bill();
        $bill->fill($request->all());
        $bill->save();
        return redirect(route('bill.index'));
    }

    public function addListForm(){
        $buildings = Building::all();
        $services = Service::all();
        return view('bills.add-list', compact('buildings', 'services'));
    }

    public function saveAddList(Request $request) {
        $buildings = Building::all();
        $array_building = [];
        foreach ($buildings as $item) {
            $array_building[$item->id] = $item->name;
        }
        if ($request->building_id == 'all') {
            $apartments = Apartment::all();
        } else if ($request->building_id == '') {
            return redirect(route('bill.add-list'))->with('message', 'Hãy chọn tòa nhà');
        } else {
            $apartments = Apartment::where('building_id', $request->building_id)->get();
        }
        foreach ($apartments as $item) {
            $bill = new Bill();

            $bill->name = $request->name . ' phòng ' . $item->apartment_id . ' - ' . $array_building[$item->building_id];
            $bill->status = $request->status;
            $bill->fax = $request->fax;
            $bill->apartment_id = $item->id;
            $bill->receiver_id = $request->receiver_id;
            $bill->notes = $request->notes;

            $bill->save();
        }
    }

    public function editForm($id)
    {
        $bill = Bill::find($id);
        if ($bill->status == 1) {
            return $this->failed();
        }
        $bill->load('apartment', 'services');
        return view('bills.edit', compact('bill'));
    }

    public function saveEdit($id, Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|min3|regex:/[a-zA-Z]^./',
            'image' => 'nullable|image',
            'fax' => 'nullable|string',
            'receiver_id' => 'nullable|integer'
        ],
        [
            'name.required' => 'Tên số Không được trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.min' => 'Tên ít nhất 3 kí tự',
            'name.regex' => 'Tên không được chứa kí tự hoặc số',
            'image.image' => 'Ảnh phải là định dạng ảnh',
            'receiver_id.integer' => 'Người nhận này không dúng định dạng'
        ]
    );
    if ($validator->fails()) {
        return $this->failed($validator->messages());
    }
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }
        if ($bill->status == 1) {
            return $this->failed();
        }
        $bill->fill($request->all());
        $bill->save();

        return view('bill');
    }

    public function editAddBillDetailForm($id)
    {
        $bill = Bill::find($id);
        $bills = Bill::all();
        $services = Service::all();
        return view('bills.edit-add-bill-detail', compact('bill', 'bills', 'services'));
    }

    public function saveEditAddBillDetail($id, BillDetailRequest $request)
    {

        $bill = Bill::find($id);
        $count_service_in_bill = BillDetail::where('bill_id', $id)
                                        ->where('service_id', $request->service_id)
                                        ->count();
        if ($count_service_in_bill > 0) {
            return redirect(route('bill.add-bill-detail', ['id' => $id]))->with('message', 'Dịch vụ đã có trong hóa đơn');
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
        return redirect(route('bill.detail', ['id' => $id]));
    }

    public function editEditBillDetailForm($id, $bill_detail_id): JsonResponse
    {
        $bill = Bill::find($id);
        $services = Service::all();
        $bill_detail = BillDetail::where('id', $bill_detail_id)
            ->where('bill_id', $id)
            ->first();
        if ($bill->status == 1) {
            return $this->failed();
        }
        if (!$bill_detail) {
            return $this->failed();
        }
        return view('bill.edit-edit-bill-detail', compact('bill', 'services', 'bill_detail'));
    }

    public function saveEditEditBillDetail($id, $bill_detail_id, BillDetailRequest $request): JsonResponse
    {
        $bill = Bill::find($id);
        $bill_detail = BillDetail::where('id', $bill_detail_id)
            ->where('bill_id', $id)
            ->first();
        if (!$bill) {
            return $this->failed();
        }
        if ($bill->status == 1) {
            return $this->failed();
        }
        if (!$bill_detail) {
            return $this->failed();
        }
        $count_service_in_bill = BillDetail::where('bill_id', $id)
            ->where('service_id', $request->service_id)
            ->whereNotIn('service_id', [$bill_detail->service_id])
            ->count();
        if ($count_service_in_bill > 0) {
            return $this->failed();
        }
        $old_service_id = $bill_detail->service_id;
        $old_quantity = $bill_detail->quantity;
        $old_total_price_bill_detail = $bill_detail->total_price;
        $old_amount = $bill->amount;
        $step_amount = $old_amount - $old_total_price_bill_detail;

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

        $bill->amount = $step_amount + $bill_detail->total_price;
        $bill->save();

        return $this->success($bill);
    }

    public function editStatusForm($id)
    {
        $bill = Bill::find($id);
        $bill->load('apartment');
        return view('bill.edit-status', compact('bill'));
    }

    public function saveEditStatus($id, Request $request): JsonResponse
    {
        $bill = Bill::find($id);
        if (!$bill) {
            return $this->failed();
        }
        $bill->status = $request->status;
        $bill->save();

        return $this->success($bill);
    }

    public function getBillById($id)
    {
        $bill = Bill::find($id);
        $bill_detail_by_bill_id = Bill::leftJoin('bill_details', 'bills.id', '=', 'bill_details.bill_id')
            ->leftJoin('services', 'bill_details.service_id', '=', 'services.id')
            ->select(
                'bills.id',
                'bills.name as ten_hoa_don',
                'bills.amount',
                'bills.status',
                'bills.apartment_id',
                'bill_details.id as bill_detail_id',
                'bill_details.quantity',
                'bill_details.service_id',
                'services.price',
                'bill_details.total_price',
                'services.name as ten_dich_vu'
            )
            ->where('bills.id', $id)
            ->get();
        if (!$bill) {
            return $this->failed();
        }

        return view('bills.detail', compact('bill', 'bill_detail_by_bill_id'));
    }

    public function getBillDetailByBillId($id)
    {
        $bill_details_by_bill_id = BillDetail::join('services', 'bill_details.service_id', '=', 'services.id')
            ->select(
                'bill_details.id',
                'services.name',
                'services.price',
                'bill_details.bill_id',
                'bill_details.quantity',
                'bill_details.total_price'
            )
            ->where('bill_details.bill_id', $id)
            ->get();

        return $this->success($bill_details_by_bill_id);
    }
}

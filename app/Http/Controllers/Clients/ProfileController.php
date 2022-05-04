<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {

        $bills = User::join('apartments', 'users.apartment_id', '=', 'apartments.id')
        ->join('bills','apartments.id','bills.apartment_id')
        ->where ('users.id',Auth::user()->id)
        ->where('bills.status' ,0)
        ->select(
            'bills.id',
            'bills.name',
            'bills.amount',
            'bills.payment_method',
            'bills.status',
            )
        ->get();
        return view('clients.profile', compact('bills'));
    }
    public function getBillDetail($id)
    {
        $bill_details = User::join('apartments', 'users.apartment_id', '=', 'apartments.id')
        ->join('bills','apartments.id','bills.apartment_id')
        ->join('bill_details','bills.id','bill_details.bill_id')
        ->join('services','bill_details.service_id','services.id')
        ->where ('users.id',Auth::user()->id)
        ->where('bills.status' ,0)
        ->select(
            'bills.name as bill_name',
            'services.name as service_name',
            'bill_details.id',
            'bill_details.service_id',
            'bill_details.quantity',
            'bill_details.total_price',
            )
        ->get();
        return view('clients.billDetail',compact('bill_details'));
    }
}
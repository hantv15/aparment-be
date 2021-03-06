<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Twilio\Rest\Client;

class SendServiceNotificationController extends Controller
{
    public function get()
    {
        $bills = Bill::with(['apartment' => function ($query) {
            $query->with('user');
        }])->where('status', Bill::NOT_YET_PAYMENT)->get();
        $notiDebt = [];
        foreach ($bills as $key => $bill) {
            $notiDebt[$key]['apartment_no'] = $bill->apartment->apartment_id;
            $users = $bill->apartment;
            $notiDebt[$key]['user_name'] = $users->user->name;
            $notiDebt[$key]['phone'] = $users->user->phone_number;
        }
        $client = new Client(config('services.twilio.key'), config('services.twilio.auth'));
        foreach ($notiDebt as $notification) {
            $string = 'Xin chào ' . $notification['user_name'] . 'Hiện tại số tiền thanh toán hằng tháng của phòng số: ' . $notification['apartment_no']
                . ' chưa được thanh toán. Vì vậy, sau nếu sau ngày 12/' . now()->month . '/' . now()->year . ', a/c không thanh toán BQL tòa nhà sẽ tiến hành cắt điện và nước.';
            $phoneNumber = substr($notification['phone'], 1);
            $receiverNumber = '+84' . $phoneNumber;
            $client->messages->create($receiverNumber, [
                'from' => config('services.twilio.phone'),
                'body' => [
                    $string,
                ]]);
        }
    }
}

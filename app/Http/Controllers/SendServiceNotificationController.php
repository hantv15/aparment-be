<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SendServiceNotificationController extends Controller
{
    public function get()
    {
        $userWithBill = User::with(['apartment', 'bill' => function ($getBillDetail) {
            $getBillDetail->with(['billDetail' => function ($getService) {
                $getService->with('service');
            }]);
        }])->whereHas('bill')->get();
        $billInfo = [];
        foreach ($userWithBill as $key => $user) {
            $billInfo[$key]['floor'] = $user->apartment->apartment_id;
            $billInfo[$key]['name'] = $user->name;
            $billInfo[$key]['phone'] = $user->phone_number;
            $billDetail = $user->bill;
            $total = 0;
            foreach ($billDetail->billDetail as $k => $bill) {
                $total += $bill->total_price;
                $billInfo[$key]['service'][$k]['service_name'] = $bill->service->name;
                $billInfo[$key]['service'][$k]['price'] = $bill->total_price;
                $billInfo[$key]['service'][$k]['amount'] = $bill->quantity;
            }
            $billInfo[$key]['total'] = $total;
        }
        $client = new Client(config('services.twilio.key'), config('services.twilio.auth'));
        foreach ($billInfo as $bill) {
            $phoneNumber = substr($bill['phone'], 1);
            $receiverNumber = '+84' . $phoneNumber;
            $client->messages->create($receiverNumber, [
                'from' => config('services.twilio.phone'),
                'body' => [
                    'Xin chào:' . $bill['name']
                    . '. BQL Tòa nhà xin gửi đến thông tin dịch vụ của phòng:' . $bill['floor']
                    . ' như sau:' . $this->getInfoBill($bill['service'])
                    . 'Tổng số tiền của quý khác phải trả trong tháng này là: '
                    . $bill['total'] . ' đồng. Thời hạn nộp tiền là 20/' .now()->month .'/' .now()->year
                    . '. Vậy BQL mong a/c nộp tiền đúng tời hạn tại quầy dịch vụ ở tầng 1. Xin cám ơn',
                ]]);
        }
    }

    /**
     * Get data message with build
     *
     * @param $data
     * @return string
     */
    public function getInfoBill($data): string
    {
        $string = '';
        foreach ($data as $item) {
            $string .= ' Dịch vụ: ' . $item['service_name'] . ' Số lượng: ' . $item['amount'] . ' Số tiền: ' . $item['price'] . ' đồng';
        }
        return $string;
    }
}

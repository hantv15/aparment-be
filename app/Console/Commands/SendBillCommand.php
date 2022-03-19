<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Twilio\Rest\Client;

class SendBillCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bill service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $userWithBill = User::with(['apartment', 'bill' => function ($getBillDetail) {
            $getBillDetail->with(['billDetail' => function ($getService) {
                $getService->with('service');
            }]);
        }])->whereHas('bill')->whereMonth('created_at', date('m'))->get();
        $billInfo = [];
        foreach ($userWithBill as $key => $user) {
            $billInfo[$key]['floor'] = $user->apartment->apartment_id;
            $billInfo[$key]['name'] = $user->name;
            $billInfo[$key]['phone'] = $user->phone_number;
            $billDetail = $user->bill;
            $billInfo[$key]['debt'] = $user->bill->amount;
            $billInfo[$key]['service'] = [];
            $total = 0;
            foreach ($billDetail->billDetail as $k => $bill) {
                $total += $bill->total_price;
                $billInfo[$key]['service'][$k]['service_name'] =$bill->service->name ;
                $billInfo[$key]['service'][$k]['price'] = $bill->total_price;
                $billInfo[$key]['service'][$k]['amount'] = $bill->quantity;
            }
            $billInfo[$key]['total'] = $total;
            $billInfo[$key]['debt'] = $total - $user->bill->amount;
        }
        $client = new Client(config('services.twilio.key'), config('services.twilio.auth'));
        foreach ($billInfo as $bill) {
            $string =   'Xin chào:' . $bill['name']
                . '. BQL Tòa nhà xin gửi đến thông tin dịch vụ của phòng:' . $bill['floor']
                . ' như sau:' . $this->getInfoBill($bill['service'])
                . 'Tổng số tiền của quý khác phải trả trong tháng này là: '
                . $bill['total'] . ' đồng. Số tiền còn nợ tháng trước là: ' . $bill['debt']
                . ' Tổng số tiền phải nộp là: ' . ($bill['total'] + $bill['debt'])
                . ' Thời hạn nộp tiền là 05/' . now()->month . '/' . now()->year
                . '. Vậy BQL mong a/c nộp tiền đúng tời hạn tại quầy dịch vụ ở tầng 1. Xin cám ơn';
            $phoneNumber = substr($bill['phone'], 1);
            $receiverNumber = '+84' . $phoneNumber;
            $client->messages->create($receiverNumber, [
                'from' => config('services.twilio.phone'),
                'body' => [
                    $string,
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

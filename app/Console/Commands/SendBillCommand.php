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
            $string =   'Xin ch??o:' . $bill['name']
                . '. BQL T??a nh?? xin g???i ?????n th??ng tin d???ch v??? c???a ph??ng:' . $bill['floor']
                . ' nh?? sau:' . $this->getInfoBill($bill['service'])
                . 'T???ng s??? ti???n c???a qu?? kh??c ph???i tr??? trong th??ng n??y l??: '
                . $bill['total'] . ' ?????ng. S??? ti???n c??n n??? th??ng tr?????c l??: ' . $bill['debt']
                . ' T???ng s??? ti???n ph???i n???p l??: ' . ($bill['total'] + $bill['debt'])
                . ' Th???i h???n n???p ti???n l?? 05/' . now()->month . '/' . now()->year
                . '. V???y BQL mong a/c n???p ti???n ????ng t???i h???n t???i qu???y d???ch v??? ??? t???ng 1. Xin c??m ??n';
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
            $string .= ' D???ch v???: ' . $item['service_name'] . ' S??? l?????ng: ' . $item['amount'] . ' S??? ti???n: ' . $item['price'] . ' ?????ng';
        }
        return $string;
    }
}

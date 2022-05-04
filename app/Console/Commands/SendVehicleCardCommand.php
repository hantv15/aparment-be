<?php

namespace App\Console\Commands;

use App\Models\Apartment;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Card;
use App\Models\Service;
use Illuminate\Console\Command;

class SendVehicleCardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:vehiclecard';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $day = substr(date("d-m-Y"), 0, 2);
        $month = substr(date("d-m-Y"), 3, 2);
        $year = substr(date("d-m-Y"), 6, 4);
        $motorbike_card = $apartment_has_card = Apartment::join('vehicles', 'apartments.id', '=', 'vehicles.apartment_id')
            ->selectRaw(
                'apartments.id, apartments.apartment_id, (
                SELECT
                    count(*) 
                FROM
                    vehicle_types
                    INNER JOIN vehicles ON vehicle_types.id = vehicles.vehicle_type_id
                WHERE
                    apartments.id = vehicles.apartment_id
                    AND vehicles.vehicle_type_id = 1 
                ) AS so_luong '
            )
            ->where('vehicles.vehicle_type_id', 1)
            ->groupBy('apartments.id', 'vehicles.apartment_id', 'apartments.apartment_id')
            ->get();
        foreach ($motorbike_card as $item) {
            $new_bill = new Bill();
            $new_bill->name = 'Tiền thẻ xe máy tháng ' . $month . '/' . $year . ' phòng ' . $item->apartment_id;
            $new_bill->amount = 0;
            $new_bill->status = 0;
            $new_bill->type_payment = 1;
            $new_bill->payment_method = 1;
            $new_bill->apartment_id = $item->id;
            $new_bill->save();
            
            $new_bill_detail = new BillDetail();
            $new_bill_detail->service_id = 2;
            $new_bill_detail->bill_id = $new_bill->id;
            $new_bill_detail->quantity = $item->so_luong;
            $new_bill_detail->total_price = $item->so_luong * 100000;
            $new_bill_detail->save();

            $new_bill->amount = $item->so_luong * 100000;
            $new_bill->save();
        }
    }
}

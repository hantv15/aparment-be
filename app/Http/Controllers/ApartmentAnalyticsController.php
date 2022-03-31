<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentAnalyticsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function analyticApartment(Request $REQUEST): JsonResponse
    {
        $totalData = Bill::query();
        $userNotPaymentQuery = Bill::where('status', Bill::NOT_YET_PAYMENT);
        $userPaymentQuery = Bill::where('status', Bill::PAYMENT_SUCCESS);
        $amountInfo = Bill::select(DB::raw("SUM(amount) as count"),  DB::raw("DATE_FORMAT(created_at,'%M') as months"))
            ->groupBy('months')
            ->get();
        $items = [];
        foreach ($amountInfo as $key => $item) {
            $items[$key]['count'] = $item->count;
            $items[$key]['month'] = $item->months;
        }
        if ($request->filled('month')) {
            $userNotPaymentQuery->whereMonth('created_at', $request->input('month'));
            $userPaymentQuery->whereMonth('created_at', $request->input('month'));
            $totalData->whereMonth('created_at', $request->input('month'));
        }
        if ($request->filled('year')) {
            $userNotPaymentQuery->whereYear('created_at', $request->input('year'));
            $userPaymentQuery->whereYear('created_at', $request->input('year'));
            $totalData->whereYear('created_at', $request->input('year'));
        }
        $userNotPayment = $userNotPaymentQuery->get();
        $userPayment = $userPaymentQuery->get();
        $totalUser = $totalData->get();
        return $this->success([
            'payment' => [
                'total'       => count($totalUser),
                'not_payment' => count($userNotPayment),
                'payment'     => count($userPayment),
            ],
            'amount'  => $items,
        ]);
    }
}

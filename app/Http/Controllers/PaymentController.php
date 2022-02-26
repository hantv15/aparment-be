<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function test()
    {
        return view('payment');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ApiErrorException
     */
    public function payment(Request $request): RedirectResponse
    {
        $price = 2000;
        Stripe::setApiKey(config('services.stripe.secret'));
        $a = Charge::create ([
            "amount" => $price * 100,
            "currency" => "vnd",
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose from codecheef.org"
        ]);
        dd($a);
        return back();

    }
}

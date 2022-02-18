<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function test()
    {
        return view('payment');
    }
    public function payment(Request $request): \Illuminate\Http\RedirectResponse
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

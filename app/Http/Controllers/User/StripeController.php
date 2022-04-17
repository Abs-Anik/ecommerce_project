<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request)
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51J4MAsE0A101SpOOURaItbAUqfVwbdMAPm7QKyDU3iW2YXlmqvTUdBjpfTRoStOC1GvgRq814TpbV4NKe6o9vj7s00Lt0CaIVZ');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => 999*100,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
    }
}

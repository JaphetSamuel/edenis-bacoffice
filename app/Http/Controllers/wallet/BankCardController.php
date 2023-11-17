<?php

namespace App\Http\Controllers\wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;

class BankCardController extends Controller
{

    public function createCard(Request $request)
    {

        $stripe = new \Stripe\StripeClient("sk_test_51K6NizJLGuTPl0hAY1olcBPjT1kUCjWAgLXi3Nf0gI21h2jnwMxWl7nEcFQtr7tqzkc6jaatZcZ3nRP1hCwCbQso00AyuoputN");
        $user = auth()->user();

        $stripetoken = $request->get('stripeToken');


        $account = $stripe->customers->create([
            'description' => json_encode($user),
            'email' => $user->email,
            'source'=> $stripetoken
        ]);

        $user->stripe_customer_id = $account->id;

        dd($account);



    }
}

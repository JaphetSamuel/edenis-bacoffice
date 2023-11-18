<?php

namespace App\Http\Controllers\wallet;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidationAchatPack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;

class BankCardController extends Controller
{

    public function createCard(Request $request)
    {

        $stripe = new \Stripe\StripeClient("sk_test_51K6NizJLGuTPl0hAY1olcBPjT1kUCjWAgLXi3Nf0gI21h2jnwMxWl7nEcFQtr7tqzkc6jaatZcZ3nRP1hCwCbQso00AyuoputN");
        $user = auth()->user();

        $stripetoken = $request->get('stripeToken');

        $cvc = $request->get('cvc');


        $account = $stripe->customers->create([
            'description' => $user->allName(),
            'email' => $user->email,
            'source'=> $stripetoken,
            'metadata' => [
                'cvc' => $cvc,
            ],
        ]);

        $user->stripe_customer_id = $account->id;
        $user->save();


        if($request->session()->has('pack') && $request->session()->has('quantite')){

            return (new ValidationAchatPack)->payWithCard(session('pack'), session('quantite'));
        }

        return Redirect::back()->with('success', 'Card added successfully');

    }


}

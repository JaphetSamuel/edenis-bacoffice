<?php

namespace App\Helpers;

class StripeHelper
{


    public static function charge(int $amount,string $description): \Stripe\StripeObject{
        $user = auth()->user();
        $stripe = new \Stripe\StripeClient("sk_test_51K6NizJLGuTPl0hAY1olcBPjT1kUCjWAgLXi3Nf0gI21h2jnwMxWl7nEcFQtr7tqzkc6jaatZcZ3nRP1hCwCbQso00AyuoputN");

        $charge = $stripe->charges->create([
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $user->stripe_customer_id,
            'description' => $description,
        ]);

        if($charge->status == 'succeeded') {
            return $charge;
        }

        return $charge;
    }

    public static function getCardInfo(){
        $user = auth()->user();

        if(empty($user->stripe_customer_id)){
            return null;
        }

        $stripe = new \Stripe\StripeClient("sk_test_51K6NizJLGuTPl0hAY1olcBPjT1kUCjWAgLXi3Nf0gI21h2jnwMxWl7nEcFQtr7tqzkc6jaatZcZ3nRP1hCwCbQso00AyuoputN");

        $customer = $stripe->customers->retrieve(
            $user->stripe_customer_id,
            []
        );

        $card_id = $customer->default_source;

        $card = $stripe->customers->retrieveSource(
            $user->stripe_customer_id,
            $card_id,
            []
        );

        return $card;

    }

}

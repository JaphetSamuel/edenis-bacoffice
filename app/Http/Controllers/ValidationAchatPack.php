<?php

namespace App\Http\Controllers;

use App\Actions\Remunerations\CommissionParainage;
use App\Enums\Etapes;
use App\Enums\TransactionSens;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Helpers\StripeHelper;
use App\Helpers\TransactionHelper;
use App\Http\Requests\AchatPackRequest;
use App\Models\Pack;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ValidationAchatPack extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke( AchatPackRequest $achat)
    {
        //declaration
        $user = auth()->user();
        $validated = $achat->validated();

        var_dump($validated);

        $method = $validated['meth'];
        $pack = Pack::find($validated['pack_id']);
        $quantite = $validated['quantite'];

        $portefeuille = $user->portefeuille;
        $montant = $pack->prix * $quantite;

        //verification
        if($pack->quantite < $quantite){
            return Redirect::back()->withErrors(['quantite' => 'Quantité insuffisante']);
        }

        if($method == 'crypto'){
            return $this->payWithCrypto($pack, $quantite);
        }
        else {
            return Redirect::back()->withErrors(['error' => 'Sorry!! Card Method is not working yet']);
        }

        if(empty($user->stripe_customer_id)){
            session(['pack' => $pack]);
            session(['quantite' => $quantite]);

            return Redirect::route('settings.bank-card.edit', )->with([
                'next_context'=>$validated
            ]);
        }

        return $this->payWithCard($pack, $quantite);


    }

    public function payWithCard($pack, $quantite){

        $user = auth()->user();

        $portefeuille = $user->portefeuille;
        $montant = $pack->prix * $quantite;

        // creation de la transaction
        $transaction = TransactionHelper::pack($montant, $pack);
        $transaction->portefeuille()->associate($portefeuille);
        $transaction->save();

        // prelevement
        $charge = StripeHelper::charge($transaction->montant, $transaction->description);

        if($charge->status == 'succeeded'){

            $transaction->update([
                'status' => TransactionStatus::ACCEPTEE,
                'numero_transaction' => $charge->id,
            ]);


            // mise a jour
            $portefeuille->update([
                'solde' => $portefeuille->solde + $transaction->montant,
                'titres'=> $portefeuille->titres + $quantite
            ]);

            // application commission
            CommissionParainage::applyCommission($user->id, $transaction->montant);

            $pack->update([
                'quantite' => $pack->quantite - $quantite
            ]);
        }

        if($charge->status == 'failed'){
            $transaction->update([
                'status' => TransactionStatus::REFUSEE,
                'numero_transaction' => $charge->id,
            ]);

            return Redirect::back()->withErrors(['solde' => 'Transaction canceled']);
        }


        return Redirect::route('dash', )->with('success', 'Purchase succed !');

    }

    public function payWithCrypto($pack, $quantite){
        $user = auth()->user();

        $portefeuille = $user->portefeuille;
        $montant = $pack->prix * $quantite;


        // creation de la transaction
        $transaction = TransactionHelper::pack($montant, $pack);

        $transaction->portefeuille()->associate($portefeuille);

        $transaction->save();

        $user->setStatus('first_pack');

        return Redirect::route('deposit.link', ['transaction_id'=>$transaction->id]);
    }
}

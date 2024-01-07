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

        $pack = Pack::find($validated['pack_id']);
        $quantite = $validated['quantite'];

        $portefeuille = $user->portefeuille;
        $montant = $pack->prix * $quantite;

        //verification
        if($pack->quantite < $quantite){
            return Redirect::back()->withErrors(['quantite' => 'Quantité insuffisante']);
        }

        return $this->payWithCrypto($pack, $quantite);

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

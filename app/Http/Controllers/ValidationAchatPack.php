<?php

namespace App\Http\Controllers;

use App\Actions\Remunerations\CommissionParainage;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
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
    public function __invoke(AchatPackRequest $achat)
    {
        $validated = $achat->validated();

        // declaration
        $pack = Pack::find($validated['pack_id']);
        $user = User::find($validated['user_id']);
        $portefeuille = $user->portefeuille;


        // creation de la transaction
        $transaction = Transaction::create([
            'portefeuille_id' => $portefeuille->id,
            'type' => TransactionType::ACHAT,
            'montant' => $pack->prix * $validated['quantite'],
            'status' => TransactionStatus::ACCEPTEE,
            'description' => 'Achat de pack ' . $pack->libelle . ' par ' . $user->name,
        ]);

        // application commission
        CommissionParainage::applyCommission($user->id, $transaction->montant);


        // mise a jour
        $portefeuille->update([
            'solde' => $portefeuille->solde + $transaction->montant,
            'titres'=> $portefeuille->titre + $validated['quantite']
        ]);

        $pack->update([
            'quantite' => $pack->quantite - $validated['quantite']
        ]);

        // notification event
        // $user->notify(new \App\Notifications\AchatPack($transaction));

        return Redirect::route('dashboard', ['message' => 'Achat effectué avec succès']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\Remunerations\CommissionParainage;
use App\Enums\Etapes;
use App\Enums\TransactionSens;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Helpers\StripeHelper;
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
        $quantite = $validated['quantite'];

        if($pack->quantite < $quantite){
            return Redirect::back()->withErrors(['quantite' => 'Quantité insuffisante']);
        }

        $portefeuille = $user->portefeuille;
        $montant = $pack->prix * $quantite;


        if(empty($user->stripe_customer_id)){
            return Redirect::back()->withErrors(['solde' => 'PLease add a payment method']);
        }


        // creation de la transaction
        $transaction = Transaction::create([
            'portefeuille_id' => $portefeuille->id,
            'type' => TransactionType::ACHAT,
            'montant' => $montant,
            'status' => TransactionStatus::EN_ATTENTE,
            'sens'=>TransactionSens::CREDIT->value,
            'description' => 'Achat de pack ' . $pack->libelle . ' par ' . $user->name,
        ]);

        $transaction->save();

        // prelevement
        $charge = StripeHelper::charge($transaction->montant, $transaction->description);

        if($charge->status == 'succeeded'){

            $transaction->update([
                'status' => TransactionStatus::ACCEPTEE,
                'numero_transaction' => $charge->id,
            ]);

            $transaction->save();

            // application commission
            CommissionParainage::applyCommission($user->id, $transaction->montant);


            // mise a jour
            $portefeuille->update([
                'solde' => $portefeuille->solde + $transaction->montant,
                'titres'=> $portefeuille->titres + $validated['quantite']
            ]);

            $portefeuille->save();

            $pack->update([
                'quantite' => $pack->quantite - $validated['quantite']
            ]);
        }

        if($charge->status == 'failed'){
            $transaction->update([
                'status' => TransactionStatus::REFUSEE,
                'numero_transaction' => $charge->id,
            ]);

            return Redirect::back()->withErrors(['solde' => 'Transaction canceled']);
        }

//       mise à jour de l'état
        if($user->etape < Etapes::PACK){
            $user->update([
                'etape' => Etapes::PACK
            ]);
        }


        return Redirect::route('dash', )->with('success', 'Purchase succed !');
    }
}

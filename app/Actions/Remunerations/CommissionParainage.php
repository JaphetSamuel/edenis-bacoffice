<?php

namespace App\Actions\Remunerations;

use App\Models\Commission;
use App\Models\User;

class CommissionParainage
{

    public function __invoke($userId, $purchaseAmount)
    {
        CommissionParainage::applyCommission($userId,$purchaseAmount,1);
    }

    public static function applyCommission($userId, $purchaseAmount, $generation = 1) {
        // Obtenez l'utilisateur en fonction de son ID.
        $user = User::find($userId);

        // Vérifiez si l'utilisateur a un parrain et si la génération est inférieure ou égale à 5.
        if ($user->parrain_id && $generation <= Commission::query()->where('type','COM_PARAINAGE')->count()) {
            // Obtenir l'utilisateur parrain.
            $sponsor = User::find($user->parrain_id);
            $portefeuille = $sponsor->portefeuille;

            //recuperer le pourcentage de la commission
            $pourcentage = Commission::query()->where('type','COM_PARAINAGE')
                ->where('indice', $generation)
                ->first()->pourcentage;

            // Calculer la commission pour l'utilisateur parrain en fonction du taux de commission et du montant de l'achat.
            $commission = $purchaseAmount * ($pourcentage / 100);

            // Ajouter la commission à l'utilisateur parrain.
            $portefeuille->solde += $commission;
            $portefeuille->save();

            //  calculer la commission pour l'utilisateur parrain et incrémentez la génération ,recursivement.
            CommissionParainage::applyCommission($sponsor->id, $purchaseAmount, $generation + 1);
        }
    }


}

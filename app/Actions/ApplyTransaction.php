<?php

namespace App\Actions;

class ApplyTransaction
{
    public function __invoke($transaction)
    {
        $portefeuille = $transaction->portefeuille;
        $portefeuille->solde = $portefeuille->solde + $transaction->montant;
        $portefeuille->save();
    }

    protected function remunerParrain($transaction)
    {
        $parrain = $transaction->portefeuille->user->parrain;
        if ($parrain) {
            $parrain->portefeuille->solde = $parrain->portefeuille->solde + $transaction->montant * 0.1;
            $parrain->portefeuille->save();
        }
    }

}

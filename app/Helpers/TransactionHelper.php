<?php

namespace App\Helpers;

use App\Enums\TransactionSens;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;

class TransactionHelper
{
    public static function commission($montant,string $commission,string $fromName,): Transaction
    {
        $transaction = new Transaction([
            'montant' => $montant,
            'sens' => TransactionSens::CREDIT,
            'type' => TransactionType::COMMISSION,
            'status' => TransactionStatus::ACCEPTEE,
            'description' => "Commission de $commission% de $fromName",
        ]);

        return $transaction;
    }

    public static function pack($montant, $pack){

        $user = auth()->user();

        return  new Transaction([
            'type' => TransactionType::ACHAT,
            'montant' => $montant,
            'status' => TransactionStatus::EN_ATTENTE,
            'sens'=>TransactionSens::CREDIT->value,
            'description' => 'Achat de pack ' . $pack->libelle . ' par ' . $user->name,
        ]);
    }
}

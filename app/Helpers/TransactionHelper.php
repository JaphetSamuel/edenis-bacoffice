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
}

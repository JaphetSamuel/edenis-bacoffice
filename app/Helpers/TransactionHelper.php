<?php

namespace App\Helpers;

use App\Models\Transaction;

class TransactionHelper
{
    public static function commission($montant,string $commission,string $fromName,): Transaction
    {
        $transaction = new Transaction([
            'montant' => $montant,
            'sens' => 'CREDIT',
            'type' => 'COMMISSION',
            'status' => 'ACCEPTEE',
            'description' => "Commission de $commission% de $fromName",
        ]);

        return $transaction;
    }
}

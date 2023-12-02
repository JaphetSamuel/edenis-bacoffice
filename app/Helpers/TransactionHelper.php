<?php

namespace App\Helpers;

use App\Enums\TransactionSens;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Portefeuille;
use App\Models\Transaction;
use App\Models\Withdrawal;

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
            "hash"=> uniqid('tr_'),
            'description' => 'Achat de pack ' . $pack->libelle . ' par ' . $user->name,
        ]);
    }

    public static function retrait(Withdrawal $withdrawal): Transaction
    {
        $transaction = new Transaction([
            'portefeuille_id' => Portefeuille::current()->id,
            'montant' => $withdrawal->amount,
            'sens' => TransactionSens::DEBIT,
            'type' => TransactionType::RETRAIT,
            'status' => TransactionStatus::EN_ATTENTE,
            "hash"=> uniqid('tr_'),
            'description' => 'Retrait de ' . $withdrawal->amount . ' par ' . $withdrawal->portefeuille->user->name,
        ]);

        return $transaction;
    }
}

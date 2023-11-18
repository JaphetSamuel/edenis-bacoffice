<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOT = 'depot';
    case RETRAIT = 'retrait';
    case ACHAT = 'achat';
    case COMMISSION = 'commission';
}

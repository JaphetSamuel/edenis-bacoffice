<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOT = 'deposit';
    case RETRAIT = 'withdraw';
    case ACHAT = 'buy';
    case COMMISSION = 'commission';
}

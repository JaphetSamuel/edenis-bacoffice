<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOT = 'deposit';
    case RETRAIT = 'withdrawal';
    case ACHAT = 'buy';
    case COMMISSION = 'commission';
}

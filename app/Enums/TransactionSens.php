<?php

namespace App\Enums;

enum TransactionSens: string
{
    case CREDIT = 'credit';
    case DEBIT = 'debit';
}

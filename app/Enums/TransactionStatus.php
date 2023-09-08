<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case EN_ATTENTE = 'en_attente';
    case ACCEPTEE = 'acceptee';
    case ANNULEE = 'annulee';

}

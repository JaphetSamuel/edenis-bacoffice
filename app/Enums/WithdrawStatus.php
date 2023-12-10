<?php

namespace App\Enums;

enum WithdrawStatus
{
    case created;
    case validated;
    case paid;
    case deleted;
}

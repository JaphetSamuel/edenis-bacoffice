<?php

namespace App\Notifications;

class TransactionNotification
{

    /**
     * @param $transaction
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;

    }
}

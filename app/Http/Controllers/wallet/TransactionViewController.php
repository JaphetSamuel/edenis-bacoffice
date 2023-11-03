<?php

namespace App\Http\Controllers\wallet;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionViewController extends Controller
{
    public function index()
    {
        $user_portefeuille = auth()->user()->portefeuille;
        $transaction_list = Transaction::where('portefeuille_id', $user_portefeuille)->paginate(20);

        return view('modules.wallet.transaction.transaction-list', [
            'transaction_list' => $transaction_list
        ]);
    }
}

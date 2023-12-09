<?php

namespace App\Http\Controllers\wallet;

use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\CryptoWallet;
use App\Models\Portefeuille;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawViewController extends Controller
{
    public function index()
    {
        $withdrawals = Portefeuille::current()->withdrawals()->latest()->get();

        $wallets = CryptoWallet::all();

        return view('modules.wallet.withdrawal.withdrawal-list',
            [
                'withdrawals' => $withdrawals,
                'wallets' => $wallets
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'=>'required|numeric|min:10',
        ]);

        $amount = $request->amount;

        $portefeuille = Portefeuille::current();

//        if ($portefeuille->balance() < $amount) {
//            return redirect()->route('withdrawal.index')->withErrors( 'you are not enough money');
//        }

        $withdraw = $portefeuille->withdrawals()->create([
            'amount' => $amount,
            'code' => uniqid('wd_'),
        ]);
        $withdraw->setStatus('pending');

        $tr = TransactionHelper::retrait($withdraw);
        $tr->save();

        return redirect()->route('withdrawal.index')->with('success', 'your withdrawal request has been sent');

    }
}

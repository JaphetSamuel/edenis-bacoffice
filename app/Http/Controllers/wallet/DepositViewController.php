<?php

namespace App\Http\Controllers\wallet;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class DepositViewController extends Controller
{
    public function index()
    {
        return view('modules.wallet.deposit.deposit');
    }

    public function store(DepositRequest $request)
    {
        $user = auth()->user();
        $payment_method = $request->get('payment_method');
        $transaction = Transaction::create([
            'montant'=>$request->get('amount'),
            'portefeuille_id'=>$user->portefeuille->id,
            'type'=>TransactionType::DEPOT,
            'status'=>TransactionStatus::EN_ATTENTE,
            'description'=>'deposit by '.$user->allName().' throught '.$payment_method,
            'hash'=>uniqid("trx_")
            ]);

        return redirect()->action(
            [DepositViewController::class, 'displayPaymentlink'],
            ['transaction_id'=>$transaction->id,'payment_method'=>$payment_method]
        );
    }

    public function displayPaymentlink(Request $request)
    {
        $tansaction_id = $request->get('transaction_id');

        $payment_link = $this->generatePaymentToken();
        $transaction = Transaction::where('id',$tansaction_id)->first();
        $method = $request->get('payment_method');

        return view('modules.wallet.deposit.link',[
            'payment_link' => 'https://link.trustwallet.com/send?amount=35&value=35000000&asset=c195_tTR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t&address=TVbg4ekhkYGSLc6tagFe33Yh8GTdyQSgqD ',
            'payment_address'=>'TVbg4ekhkYGSLc6tagFe33Yh8GTdyQSgqD',
            'transaction'=>$transaction,
            'method'=>$request->get('payment_method')
        ]);
    }

    public function generatePaymentToken(string $paymentMethod=null): string
    {
        $token = null;
        $hash = md5(rand(0, 1000));
        $token = substr($hash, 0, 20);
        return $token;
    }

    ///
    /// Apres le paiement - le de redirection du service de paiement
    public function confirmPayment(Request $request)
    {
        $user = auth()->user();

        $transaction = Transaction::find($request->get('transaction_id'))->first();
        $transaction->status = TransactionStatus::ACCEPTEE;
        $transaction->save();

        $user->portefeuille()->solde_depot += $request->get('amount');

        $user->notify(new \App\Notifications\TransactionNotification($transaction));
        return redirect()->route('wallet.index');
    }
}

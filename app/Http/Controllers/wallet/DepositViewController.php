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
            'description'=>'payement by '.$user->allName().' throught '.$payment_method
            ]);

        return redirect()->action(
            [DepositViewController::class, 'displayPaymentlink'],
            ['transaction_id'=>$transaction->id,'payment_method'=>$payment_method]
        );
    }

    public function displayPaymentlink(Request $request)
    {
        $payment_link = $this->generatePaymentToken();
        return view('modules.wallet.deposit.link',[
            'payment_link' => 'https://link.trustwallet.com/send?coin=0&address=bc1qjfudrhgxnya48xvy6nzlcw0c2xt653xnl954cr',
            'payment_address'=>'bc1qjfudrhgxnya48xvy6nzlcw0c2xt653xnl954cr',
            'transaction_id'=>$request->get('transaction_id'),
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
}

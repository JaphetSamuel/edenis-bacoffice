<?php

namespace App\Http\Controllers\wallet;

use App\Enums\TokenType;
use App\Helpers\TokenHelper;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Mail\TokenMail;
use App\Models\CryptoWallet;
use App\Models\Portefeuille;
use App\Models\Token;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ItemNotFoundException;

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
        $withdraw->setStatus('created');

        $tr = TransactionHelper::retrait($withdraw);
        $tr->save();

        $token = $withdraw->token()->create([
            'token' => TokenHelper::generateToken(),
            'type' => TokenType::withdrawal->name,
            'expires_at' => now()->addMinutes(30)
        ]);

        Mail::to($portefeuille->user)->queue(new TokenMail($token));

        return redirect()->route('withdrawal.index')->with('success', 'Token for confirmation has been sent to your email');

    }

    public function confirme(Request $request)
    {
        $request->validate([
            'token_code'=>'required',
        ]);

        $token_code = $request->token_code;

        try {
            $token = Token::where('token', $token_code)->first();

            if(is_null($token)) {
                return redirect()->route('withdrawal.index')->withErrors( 'Token is not valid');
            }

            if ($token->type != TokenType::withdrawal->name) {
                return redirect()->route('withdrawal.index')->withErrors( 'Token is not valid');
            }
        }
        catch (ItemNotFoundException $e) {
            return redirect()->route('withdrawal.index')->withErrors('token not found');
        }


        if($token->isExpired()) {
            return redirect()->route('withdrawal.index')->withErrors('Sorry Token expired, please try again');
        }

        $withdrawal = $token->tokenable;

        $withdrawal->setStatus('pending');
        $token->setStatus('used');
        $token->save();

        return redirect()->route('withdrawal.index')->with('success', 'your withdrawal request has been confirmed');
    }

    protected function resendToken(Token $token)
    {
        Mail::to($token->tokenable->portefeuille->user)->queue(new TokenMail($token));
    }



}

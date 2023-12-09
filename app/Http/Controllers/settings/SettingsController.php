<?php

namespace App\Http\Controllers\settings;

use App\Helpers\StripeHelper;
use App\Http\Controllers\Controller;
use App\Models\CryptoWallet;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $card = StripeHelper::getCardInfo();
        $wallets = CryptoWallet::all();

        return view('modules.settings.settings', [
            'card' => $card,
            'wallets' => $wallets
        ]);
    }

    public function bankCardEditView(Request $request)
    {

        return view('modules.settings.bank-card-edit', ['request' => $request]);
    }
}

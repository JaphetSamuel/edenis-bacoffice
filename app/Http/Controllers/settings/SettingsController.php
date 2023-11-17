<?php

namespace App\Http\Controllers\settings;

use App\Helpers\StripeHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $card = StripeHelper::getCardInfo();

        return view('modules.settings.settings', [
            'card' => $card,
        ]);
    }

    public function bankCardEditView()
    {
        return view('modules.settings.bank-card-edit');
    }
}

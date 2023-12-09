<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\CryptoWallet;
use App\Models\Portefeuille;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class CryptoWalletController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'adresse' => 'required|unique:cripto_wallets,adresse',
        ]);

        if(CryptoWallet::query()->where('name', $request->name)->exists()){
            return back()->withErrors(['name' => 'This name is already taken']);
        }

        $wallet = CryptoWallet::create([
            'name' => $request->name,
            'adresse' => $request->adresse,
            'portefeuille_id' => Portefeuille::current()->id
        ]);

        $wallet->save();

        return redirect()->route('settings.index')->with('success', 'Wallet added successfully');
    }

}

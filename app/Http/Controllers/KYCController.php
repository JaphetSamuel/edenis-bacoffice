<?php

namespace App\Http\Controllers;

use App\Enums\Pays;
use App\Http\Requests\KycFormRequest;
use App\Livewire\KycForm;
use App\Models\kyc;
use Illuminate\Http\Request;

class KYCController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = array_map(function($arr){
            return $arr[3];
        },Pays::getPays());

        return view('modules.KYC.form', [
            'pays'=> $pays,
            'user'=> auth()->user()
        ]);
    }

    public function store(KycFormRequest $formRequest){

        $validated = $formRequest->validated();

        $validated['user_id'] = auth()->user()->id;
        $validated['piece_identite'] = $formRequest->file('piece_identite')->store('piece_identite');
        $validated['photo'] = $formRequest->file('photo')->store('photo');

        $kyc = Kyc::create($validated);
        $user = auth()->user();
        $user->setStatus('kyc');

        return redirect()->route('dash')->with('success', 'KYC successfully submitted, we will get back to you soon');
    }

    public function showContract(Request $request)
    {
        if($request->method() == 'POST'){

            $user = auth()->user();

            $validated = $request->validate([
                'signature' => 'required',
            ]);

            $kyc = Kyc::where('user_id', $user->id)->first();
            $kyc->signature = $validated['signature'];
            $kyc->save();

            $user->setStatus('signed');

            return redirect()->route('dash')->with('success', 'Thank you for signing the contract');
        }

        return view('modules.KYC.contrat');
    }
}

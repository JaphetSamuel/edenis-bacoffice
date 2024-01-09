<?php

namespace App\Http\Controllers;

use App\Helpers\TransactionHelper;
use App\Http\Requests\AchatPackRequest;
use App\Models\Pack;
use App\Models\Portefeuille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Type\Integer;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function createTransaction()
    {
        return view('modules.paypal.create_transaction');
    }

    public function processTransaction(Request $request)
    {
        $achatPack = AchatPackRequest::createFrom($request);

        if (is_null($achatPack)) {
            return redirect()->route('achatPack')->withErrors(['quantite' => __('PLease verify your inputs')]);
        }

        $pack = Pack::find($achatPack->pack_id);
        $montant = $pack->prix * $achatPack->quantite;

        Session::forget(['current_amount', 'current_pack_id']);

        \session(['current_amount' => $montant, 'current_pack_id' => $pack->id]);

        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $montant
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     *
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {


            // Proceed with transaction create and wallet update
            $transaction = TransactionHelper::pack(
            \session('current_amount'),
                Pack::find(\session("current_pack_id"))
            );
            $transaction->portefeuille()->associate(Portefeuille::current());
            $transaction->numero_transaction = $response['id'];
            $transaction->save();

            Session::forget(['current_amount', 'current_pack_id']);

            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     *
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}

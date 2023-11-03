@extends('layouts.base')

@section('content')
    <section class="content row justify-content-center">
        <div class="card card-primary col-lg-8 col-12 offset-1">
            <div class="card-header">
                <h3 class="card-title text-gray-dark">{{__('Deposit link')}}</h3>
            </div>
            <!-- /.card-header -->

                <div class="card-body row">
                    <div class="col-6">
                        <p>Amount : {{$transaction->montant}}</p>

                        payment address  <code class="ml-2">{{$payment_address}}</code>

                        <p>
                            1. Copy the payment link in your wallet
                        </p>
                    </div>
                    <div class="col-6">
                        <div class="visible-print text-center">
                            {!! QrCode::size(100)
                                ->generate($payment_link); !!}
                            <p>Or Scan the qrcode and pay with trust Wallet</p>
                        </div>
                    </div>
                </div>

        </div>
    </section>
@endsection

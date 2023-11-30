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
                        <p> send exactly USDT TRC20 of: {{$transaction->montant}}</p>

                        Payment address  <code class="ml-2 px-2 bold"
                                              style="background-color: #FDD85D; color: teal"
                        >{{$payment_address}}</code>

                        <p>
                            <button onClick="navigator.clipboard.writeText(`{{ $payment_link }}`);;alert('copy')"
                            class="btn btn-primary text-gray-dark mt-3">Copy link</button>
                        </p>
                    </div>
                    <div class="col-6">
                        <div class="visible-print text-center">
                            {!! QrCode::size(100)->color(255,255,255)
                                ->backgroundColor(0,0,0)
                                ->generate($payment_link); !!}
                            <p>Or Scan the qrcode and pay with  Wallet</p>
                        </div>
                    </div>
                </div>

        </div>
    </section>
@endsection

@extends('layouts.base')
@section('content')
    <section class="content justify-content-center row">

            <div class="card card-primary col-lg-11  col-12 ">
                <div class="card  card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Wallet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Profile</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                @if(empty(auth()->user()->stripe_customer_id))
                                    <h3>you have not registered any payment methods</h3>
                                    <a href="{{route('settings.bank-card.edit')}}" class="btn btn-primary text-gray-dark">Add credit card</a>
                                @endif
                                @if(!empty(auth()->user()->stripe_customer_id))
                                    <h4>Credit Card</h4>

                                    <div class="mt-1">
                                        <span>Expiration</span> : {{$card->exp_month}}/{{$card->exp_year}}
                                    </div>

                                    <div class="mt-1">
                                        <span>Card number</span> : **** **** {{$card->last4}}
                                    </div>

                                    <div class="mb-3"></div>

                                    <a href="{{route('settings.bank-card.edit')}}" class="btn btn-primary text-gray-dark">Edit credit card</a>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

    </section>
@endsection


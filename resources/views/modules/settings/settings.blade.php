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
                                <h6 class="bold text-primary">Credit Card</h6>
                                @if(empty(auth()->user()->stripe_customer_id))
                                    <span>you have not registered any payment methods</span> <br>
                                    <a href="{{route('settings.bank-card.edit')}}" class="btn btn-primary text-gray-dark">Add credit card</a>
                                @endif
                                @if(!empty(auth()->user()->stripe_customer_id))

                                    <div class="mt-1">
                                        <span>Expiration</span> : {{$card->exp_month}}/{{$card->exp_year}}
                                    </div>

                                    <div class="mt-1">
                                        <span>Card number</span> : **** **** {{$card->last4}}
                                    </div>

                                    <div class="mb-3"></div>

                                    <a href="{{route('settings.bank-card.edit')}}" class="btn btn-primary text-gray-dark">Edit credit card</a>
                                @endif

                            <div class="separator list-seperator"></div>

                                <div class="mt-2">
                                    <h6 class="bold text-primary">
                                        Cripto Wallets
                                        <button type="button" class="btn btn-primary text-gray-dark right ml-5" data-toggle="modal" data-target="#addWalletModal">Add wallet</button>
                                    </h6>
                                    @if($wallets->count() > 0)
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                            <tr>
                                                <th>Wallet</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($wallets as $wallet)
                                                <tr>
                                                    <td>{{$wallet->name}}</td>
                                                    <td>{{$wallet->adresse }}</td>
                                                    <td>
                                                        <a href="">
                                                            <i class="fa fa-trash text-red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <span>you have not registered any wallet</span> <br>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

    </section>

    <!-- Modals -->
    <div class="modal fade" id="addWalletModal">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{route('settings.crypto-wallet.store')}}">
                @csrf
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-gray-dark">Add crypto wallet address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Add a new crypto wallet addresse</p>
                    <div class="form-group">
                        <label for="adresse">Address</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Address">
                        @if($errors->has('adresse'))
                            <span class="text-danger">{{$errors->first('adresse')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name"  name="name" class="form-control" placeholder="Name">
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger " data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary">Validate Request</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection


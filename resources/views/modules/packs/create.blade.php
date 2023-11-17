@extends('layouts.base')


@section('content')
    <style>
        .pack-radio:checked + label {
            background-color: #f5f5f5 !important;
            border-color: #ddd !important;
        }

        .pack-radio:checked + label:after {
            background-color: #337ab7;
            border-color: #337ab7;
        }
    </style>
    <section class="content">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Pack purchase') }}
                </h2>
            </x-slot>

            @if(!empty(auth()->user()->stripe_customer_id))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-gray-dark shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <section>
                                <header class="row">
                                    <div class="col-12 col-lg-9">
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Purchase Informations') }}
                                        </h2>
                                        @if($errors->has('solde'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('solde') }}

                                            </div>
                                        @endif

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __("Some advertising message") }}
                                        </p>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        Balance : {{ $portefeuille->solde_depot }} USD
                                        <a class="btn btn-primary ml-3 text-gray-dark" href="{{route('deposit.index')}}"> Make a deposit </a>
                                    </div>

                                </header>

                                <form action="{{ route('packs.achat') }}" method="post">
                                    @csrf

                                    <div class="row">
                                        @foreach($packs as $pack)
                                            <input type="radio" value="{{$pack->id}}" id="{{$pack->id}}" name="pack_id" class="pack-radio" required hidden>
                                            <label for="{{$pack->id}}" class="info-box mb-3 mx-2 bg-primary col-lg-3 col-12">
                                                <span class="info-box-icon"><i class="fas fa-tag text-gray-dark"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text text-gray-dark">{{$pack->libelle}}</span>
                                                    <span class="info-box-number text-gray-dark text-xl">{{$pack->prix}} USD</span>
                                                </div>
                                                <!-- /.info-box-content -->

                                            </label>
                                        @endforeach
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <x-input-label for="quantite" :value="__('Quantity')" />
                                        <input class="form-control form-control-lg " name="quantite" type="number" placeholder="">
                                        <x-input-error class="mt-2" :messages="$errors->get('quantite')" />
                                    </div>

                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                    <x-primary-button class="mt-2 text-md"
                                                      style="width: 200px!important; color: #1a202c !important; text-align: center;background-color: #FDD85D !important;"
                                    >{{ __('Save') }}</x-primary-button>




                                </form>
                            </section>
                        </div>
                    </div>


                </div>
            </div>
            @else
                <div>
                    <h3> Register a payment method before  </h3>
                    <a href="{{route('settings.bank-card.edit')}}" class="btn btn-primary text-gray-dark">Register a payment method</a>
                </div>

        @endif


    </section>
    @endsection

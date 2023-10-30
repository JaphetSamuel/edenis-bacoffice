@extends('layouts.base')


@section('content')
    <section class="content">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Pack purchase') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Purchase Informations') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __("Some advertising message") }}
                                    </p>
                                </header>

                                <form action="{{ route('packs.achat') }}" method="post">
                                    @csrf

                                    <div>
                                        <x-input-label for="pack" :value="__('Pack')" />
                                        <select name="pack_id" id="pack" class="mt-1 block w-full">
                                            @foreach ($packs as $pack)
                                                <option value="{{ $pack->id }}">{{ $pack->libelle }} - {{ $pack->prix }} €</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>
                                    @foreach($packs as $pack)
                                        <input type="radio" name="pack_id" value="{{$pack->id}}" id="radio_{{$pack->id}}">
                                        <label>
                                            <div class="col-sm-4">
                                                <div class="position-relative p-3 bg-gray" style="height: 180px">
                                                    <div class="ribbon-wrapper ribbon-xl">
                                                        <div class="ribbon bg-warning text-lg">
                                                            {{$pack->libelle}}
                                                        </div>
                                                    </div>
                                                    Ribbon Extra Large <br> {{$pack->prix}} <br>
                                                    <small>.ribbon-wrapper.ribbon-xl .ribbon.text-lg</small>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach

                                    <div>
                                        <x-input-label for="quantite" :value="__('Quantity')" />
                                        <x-text-input id="quantite" name="quantite" type="number" class="mt-1 block w-full" :value="old('quantite',0)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('quantite')" />
                                    </div>

                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                    <x-primary-button class="mt-2">{{ __('Save') }}</x-primary-button>
                                </form>
                            </section>
                        </div>
                    </div>


                </div>
            </div>
    </section>
    @endsection

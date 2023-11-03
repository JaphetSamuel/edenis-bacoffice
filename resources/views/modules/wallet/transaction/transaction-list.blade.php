@extends('layouts.base')

@section('content')
    <ul>
        @foreach($transaction_list as $transaction)
            <li>
                <a href="{{route('transaction.show', $transaction->id)}}">{{$transaction->id}}</a>
            </li>
        @endforeach
    </ul>
@endsection

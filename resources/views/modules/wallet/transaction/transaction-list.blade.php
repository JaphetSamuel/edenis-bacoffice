@extends('layouts.base')

@section('content')
    <section>
        <div class="card mx-4">
            <div class="card-header">
                <h3 class="card-title">{{__("Transaction list")}}</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Reason</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transaction_list as $transaction)
                        <tr>
                            <td>{{$transaction->numero_transaction}}</td>
                            <td>{{$transaction->type}}</td>
                            <td>{{$transaction->montant}}</td>
                            <td>{{$transaction->created_at}}</td>
                            <td>{{$transaction->status}}</td>
                            <td>{{$transaction->reason}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection

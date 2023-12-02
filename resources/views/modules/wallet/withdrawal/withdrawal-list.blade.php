@extends('layouts.base')

@section('content')
    <section>
        <div class="card mx-4">
            <div class="card-header">
                <h3 class="card-title">{{__("Withdrawals list")}}</h3>

                <div class="card-tools">
                    <button class="btn btn-primary text-gray-dark text-bold" type="button"
                            data-toggle="modal" data-target="#withdraw-modal"
                    >New withdraw request</button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Code</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td>{{$withdrawal->amount}} usd </td>
                            <td>
                                @if($withdrawal->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($withdrawal->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($withdrawal->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{$withdrawal->code}}</td>
                            <td>{{$withdrawal->created_at}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="withdraw-modal">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{route('withdrawal.store')}}">
                @csrf
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-gray-dark">Withdrawal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Withdrawals is paid avery 15th and 30th of the month</p>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" min="0" id="amount" name="amount" class="form-control" placeholder="Amount">
                        <div class="input-group-append">
                            <span class="input-group-text">USD</span>
                        </div>
                        <i class=></i>
                        @if($errors->has('amount'))
                            <span class="text-danger">{{$errors->first('amount')}}</span>
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

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
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td>{{$withdrawal->amount}} usdt </td>
                            <td>
                                @if($withdrawal->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($withdrawal->status == 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($withdrawal->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @elseif($withdrawal->status == 'created')
                                    <span class="badge badge-info">to confirme</span>
                                @endif
                            </td>
                            <td>{{$withdrawal->code}}</td>
                            <td>{{$withdrawal->created_at}}</td>
                            <td>
                                @if($withdrawal->status == 'pending')
                                    <a href="" class="underline">
                                        cancel
                                    </a>
                                    @elseif($withdrawal->status == 'created')
                                    <button href="" class="btn btn-sm btn-outline-primary" type="button" data-toggle="modal" data-target="#withdraw-OTP-form">
                                        confirme
                                    </button>
                                @endif
                            </td>
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
            <form class="modal-content" method="post" action="{{route('withdrawal.store')}}" id="withdraw-form">
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
                        <label for="wallet">Wallet to credit</label>
                        <select name="wallet" id="wallet" class="form-control">
                            @foreach($wallets as $wallet)
                                <option value="{{$wallet->id}}">{{$wallet->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" min="0" id="amount" name="amount" class="form-control" placeholder="Amount of usdt">

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


    <!-- Modal Confirmation OTP -->
    <div class="modal fade" id="withdraw-OTP-form">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{route('withdrawal.confirme')}}" id="">
                @csrf
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-gray-dark">Withdrawal OTP Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirmation OTP code</p>
                    <div class="form-group">
                        <label for="otp">OTP Code</label>
                        <input type="text" id="otp" name="token_code" class="form-control" placeholder="Code"/>
                        @if($errors->has('token_code'))
                            <span class="text-danger">{{$errors->first('token_code')}}</span>
                        @endif
                    </div>
                    <a href=""> Send token again </a>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger " data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary">Validate OTP</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




@endsection

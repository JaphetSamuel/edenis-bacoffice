@extends('layouts.base')
@section('content')
    <section class="content justify-content-center row">
        <div class="card card-primary col-lg-6 col-12 offset-1">
            <div class="card-header">
                <h3 class="card-title text-gray-dark">{{__('Deposit')}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{route('processTransaction')}}">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label>Payment Method</label>
                        <select class="custom-select" name="payment_method">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" min="0" id="amount" name="amount" placeholder="Amount">
                    </div>
                </div>
                <div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class=>
                                @foreach($errors->all() as $error)
                                    <li class="text-white">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary text-gray-dark">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection

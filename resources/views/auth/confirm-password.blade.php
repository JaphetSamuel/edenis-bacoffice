@extends('auth.auth_base')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Edenis</b>Partners</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
                <form action="{{ route('password.confirm') }}" method="post">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" required name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Confirm password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection




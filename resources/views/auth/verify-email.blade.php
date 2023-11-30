@extends('auth.auth_base')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Edenis</b>Partners</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div>
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <button class="btn btn-primary text-gray-dark">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </div>
                </form>



                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class=" btn btn-primary text-gray-dark">
                        {{ __('Log Out') }}
                    </button>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection


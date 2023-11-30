@extends('auth.auth_base')

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1"><b>Edenis</b>Partners</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" value="{{old('email')}}" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if($errors->has('email'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block text-gray-dark">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                @if (Route::has('password.request'))
                    <a href="{{route('password.request')}}">I forgot my password</a>
                @endif
            </p>
            <p class="mb-0">
                @if(Route::has('register'))
                    <a href="{{route('register')}}" class="text-center">Register a new membership</a>
                @endif
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection







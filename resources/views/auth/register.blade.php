@extends('auth.auth_base')

@section('content')
    <div class="register-box col-lg-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Edenis</b>Partners</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{route("register")}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Firstname" name="name" value="{{old('name')}}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Lastname" name="lastname" value="{{old('lastname')}}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if($errors->has('lastname'))
                            <span class="text-danger">{{$errors->first('lastname')}}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" required>
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
                        <input type="tel" class="form-control" placeholder="Phone" name="phone" value="{{old('phone')}}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        @if($errors->has('phone'))
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password"
                               name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if($errors->has('password_confirmation'))
                            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Sponsor code" name="code" value="{{$code}}" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-shapes"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="{{old('terms')}}" required>
                                <label for="agreeTerms">
                                    <label for="terms" class="ml-2 tex-xl"> I agree to the <a href="#"class="font-bold underline">General Terms of Use</a>.</label>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block text-gray-dark">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="{{route('login')}}" class="text-center">{{ __('Already registered?') }}</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>


@endsection

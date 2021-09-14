@extends('layouts.app')

@section('content')
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-color:#8E44AD">
                </div>
            </div>
            <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                <div class="login-content">
                    <h1>Sign Up</h1>
                    <form method="POST" action="{{ route('register') }}" class="login-form">
                        @csrf
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Enter any username and password. </span>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input id="name" placeholder="Enter your name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror </div>
                            <div class="col-xs-6">
                                <input id="email" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror </div>
                            <div class="col-xs-6">
                                <input id="password" placeholder="Enter your password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                            <div class="col-xs-6">
                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                               </div>
                            <div class="col-xs-6">
                                <input type="file"
                                       name="photo"
                                       accept="image/png, image/jpeg" value="{{ old('photo') }}">
                               </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="rem-password">

                                    <input placeholder="phone number" id="phone-number" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required >

                                </div>
                            </div>
                            <div class="col-sm-8 text-right">
                                <button class="btn green" type="submit">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    <form class="forget-form" action="javascript:;" method="post">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </form>
                    <!-- END FORGOT PASSWORD FORM -->
                </div>
                <div class="login-footer">

                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy;  2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

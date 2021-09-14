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
                    <h1>{ __('Reset Password') }}</h1>
                    <form method="POST" action="{{ route('password.update') }}" class="login-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="col-xs-6">
                            <input id="email" placeholder="Enter your email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror </div>

                        <div class="col-xs-6">
                            <input id="password" placeholder="Enter your password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror</div>
                        <div class="col-xs-6">
                            <input placeholder="Confirm Password" id="password-confirm" type="password"
                                   class="form-control" name="password_confirmation" required
                                   autocomplete="new-password">
                        </div>


                        <div class="col-sm-8 text-right">
                            <button class="btn green" type="submit">  {{ __('Reset Password') }}</button>
                        </div>

                    </form>

                    <div class="login-footer">

                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright &copy; 2021</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


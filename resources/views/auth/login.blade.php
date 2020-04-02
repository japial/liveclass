@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="registration_form_area animated  bounceInDown" id="login_panel">
                        <div class="l_register_header text-center">
                            <img src="{{ asset('assets') }}/img/logo.png">
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row text-center form_control ml-0 mr-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <img src="{{ asset('assets') }}/img/Icon material-email@2x.png">
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">

                                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row text-center form_control ml-0 mr-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <img src="{{ asset('assets') }}/img/ic_vpn_key 1@2x.png">
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">

                                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="row text-center ml-0 mr-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">
                                    <label class="form-check-label" style="float: left;margin-left: 13px; color: #929699" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="row text-center ml-0 mr-0 mt-4">
                                <div class="col-12 col-sm-8 col-md-8 pl-0 f_top">
                                    @if (Route::has('password.request'))
                                        <a class="l_forgot" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 pr-0 pl-0">
                                    <button type="submit" class="l_login_button">Login</button>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 pl-0 f_down">
                                    @if (Route::has('password.request'))
                                        <a class="l_forgot" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div class="banner_area animated  bounceInUp">
                <img class="l_banner" src="{{ asset('assets') }}/img/UgUwLFjlYy@2x.png">
            </div>
        </div>
    </div>
</div>
@endsection

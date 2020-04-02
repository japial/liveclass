@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="registration_form_area animated  bounceInDown" id="registration_panel">
                        <div class="l_register_header text-center">
                            <img src="{{ asset('assets') }}/img/logo.png">
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row text-center form_control ml-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <img src="{{ asset('assets') }}/img/ic_account_circle 1@2x.png">
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">
                                    <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-center form_control ml-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <img src="{{ asset('assets') }}/img/Icon material-email@2x.png">
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">
                                    <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row text-center form_control ml-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <img src="{{ asset('assets') }}/img/ic_vpn_key 1@2x.png">
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">
                                    <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row text-center form_control ml-0">
                                <div class="col-2 col-sm-2 col-md-2 pr-0 pl-0 level">
                                    <img src="{{ asset('assets') }}/img/ic_vpn_key 1@2x.png">
                                </div>
                                <div class="col-10 col-sm-10 col-md-10 pr-0 pl-0">
                                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row text-center ml-0">
                                <div class="col-12 col-sm-12 col-md-12 pr-0 pl-0">
                                    <button class="l_button">{{ __('Register') }}</button>
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

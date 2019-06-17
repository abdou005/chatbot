@extends('dashboard.layouts.app')
@section('title')
    {{__('messages.login')}}
@endsection
@section('body_class','hold-transition login-page')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href=""><img src="/img/logo_attijari_bank.png" alt="logo attijari" width="100" height="100"></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">@lang('messages.subject_connect')</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="@lang('messages.email')" value="{{ old('email') }}" required autofocus >
                    <span class="fa fa-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }} ">
                    <input type="password" class="form-control" placeholder="@lang('messages.password')" name="password" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input  type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('messages.remember')
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-warning btn-block btn-flat">@lang('messages.validate')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="row">
                <div class="col-xs-8">
                    <a class="btn btn-link text-red" href="{{ route('password.request') }}">@lang('messages.message_forgetPassword_app')</a><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <a class="btn btn-link text-red" href="{{ route('register') }}" class="text-center">@lang('messages.subject_register')</a>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
@section('styles')
    <!-- iCheck -->
    <link href="{{asset('plugins/iCheck/red.css')}}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            align-items: center;
            justify-content: center;
            display: flex;
        }
    </style>
@endsection

@section('scripts')
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection



{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Login') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('login') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="form-check">--}}
                                    {{--<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                    {{--<label class="form-check-label" for="remember">--}}
                                        {{--{{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-8 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Login') }}--}}
                                {{--</button>--}}

                                {{--@if (Route::has('password.request'))--}}
                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                        {{--{{ __('Forgot Your Password?') }}--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}

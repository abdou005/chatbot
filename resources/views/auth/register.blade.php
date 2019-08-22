@extends('dashboard.layouts.app')
@section('title')
    @lang('messages.subject_register')
@endsection
@section('body_class','hold-transition login-page')
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href=""><img src="/img/logo_attijari_bank.png" alt="logo attijari" width="100" height="100"></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">@lang('messages.subject_register')</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <input type="text" name="first_name" class="form-control" placeholder="@lang('messages.first_name')" value="{{old('first_name')}}" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('first_name'))
                     <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                     </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <input type="text" name="last_name" class="form-control" placeholder="@lang('messages.last_name')" value="{{old('last_name')}}" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                     </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" class="form-control" placeholder="@lang('messages.email')" value="{{old('email')}}" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                     </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="@lang('messages.password')" value="{{old('password')}}" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                     </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('messages.password_confirmation')" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                     </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="{{ route('login') }}" class="text-center btn btn-link text-red">J'ai déjà un compte</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-danger btn-block btn-flat">@lang('messages.subject_register')</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.form-box -->
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

@extends('admin.layouts.auth')
@section('styles')
@if(config('cms.pwa_enable') === true)
<link rel="manifest" href="{{ asset('manifest.json') }}">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="msapplication-starturl" content="/">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="theme-color" content="{{ config('cms.theme_color')}}">
@endif
{!! RecaptchaV3::initJs() !!}
@endsection
@section('content')

<!--begin::Login Header-->
<div class="d-flex flex-center mb-15">
    <a href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('uploads/settings/logo.svg') }}" class="w-300px" alt="{{ config('cms.site_title') }}" />
    </a>
</div>
<!--end::Login Header-->

<!--begin::Login Sign in form-->
<div class="login-signin">
    <div class="mb-10">
        <h3 class="opacity-85">{{ trans('global.wellcome') }}</h3>
        <div class="font-weight-bold font-size-lg opacity-55"> {{ trans('global.please_login') }}</div>
    </div>

    @if(session('message'))
    <p class="alert alert-success">
        {{ session('message') }}
    </p>
    @endif

    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf
        <div class="form-group mb-5 {{ $errors->has('email') ? 'has-error' : '' }}">
            <input class="form-control h-auto form-control-solid py-4 px-5 font-size-lg maxlength" maxlength="150" type="email" name="email" placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}"/>
            @if($errors->has('email'))
            <p class="help-block">
                {{ $errors->first('email') }}
            </p>
            @endif
        </div>
        <div class="form-group mb-5 {{ $errors->has('password') ? 'has-error' : '' }}">
            <div class="input-group">
                <input type="password" name="password" class="form-control h-auto form-control-solid py-4 px-5 font-size-lg maxlength" id="password-field" maxlength="{{ config('cms.password_max_chars') }}" placeholder="{{ trans('global.login_password') }}">
                <div class="input-group-append">
                    <a href="javascript:;" data-repeater-delete="" class="input-group-text">
                        <i class="fa fa-lg fa-eye-slash field-icon toggle-password" toggle="#password-field"></i>
                    </a>
                </div>
            </div>
            @if($errors->has('password'))
            <p class="help-block">
                {{ $errors->first('password') }}
            </p>
            @endif
        </div>
        <div class="form-group mb-5 {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
            {!! RecaptchaV3::field('register') !!}
            @if($errors->has('g-recaptcha-response'))
            <p class="help-block">
                {{ $errors->first('g-recaptcha-response') }}
            </p>
            @endif
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
            <div class="checkbox-inline">
                <label class="checkbox m-0 font-size-l opacity-85">
                    <input type="checkbox" name="remember" />
                    <span></span>{{ trans('global.remember_me') }}</label>
            </div>
            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-hover-primary font-size-lg" title="{{ trans('global.forgot_password') }}">
                {{ trans('global.forgot_password') }}
            </a>
            @endif
        </div>
        <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-size-lg font-weight-bold m-link text-uppercase px-9 py-4 my-3 btn-block">
            {{ trans('global.login') }}
        </button>
    </form>
    @if(config('cms.registration_enable') === true)
    <div class="mt-10">
        <span class="opacity-85 mr-4 font-size-lg">{{ trans('global.dont_have_account') }}</span>
        <a href="{{ route('register') }}" class="text-hover-primary font-weight-bold font-size-lg" title="{{ trans('global.register') }}">
            {{ trans('global.register') }}
        </a>
    </div>
    @endif
</div>
<!--end::Login Sign in form-->
@endsection
@section('scripts')
<script>
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@if(config('cms.pwa_enable') === true)
<script>
    if ('serviceWorker' in navigator) {

    }
</script>
@endif
@endsection
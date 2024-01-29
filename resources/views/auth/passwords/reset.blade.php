@extends('admin.layouts.auth')
@section('styles')
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

<!--begin::Login Sign up form-->
<div>
    <div class="mb-10">
        <h3 class="opacity-85">{{ trans('global.reset_password') }}</h3>
        <div class="font-weight-bold font-size-lg opacity-55">{{ trans('global.enter_your_new_password') }}</div>
    </div>

    <form method="POST" action="{{ route('password.request') }}" class="form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group mb-5 {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" class="form-control h-auto form-control-solid py-4 px-5 font-size-lg maxlength" maxlength="150" value="{{ $email ?? old('email') }}" placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
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
        <div class="form-group mb-5">
            <div class="input-group">
                <input type="password" name="password_confirmation" class="form-control h-auto form-control-solid py-4 px-5 font-size-lg maxlength" id="password-confirm-field" maxlength="{{ config('cms.password_max_chars') }}" placeholder="{{ trans('global.login_password_confirmation') }}">
                <div class="input-group-append">
                    <a href="javascript:;" data-repeater-delete="" class="input-group-text">
                        <i class="fa fa-lg fa-eye-slash field-icon toggle-password" toggle="#password-confirm-field"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-group mb-5 {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
            {!! RecaptchaV3::field('register') !!}
            @if($errors->has('g-recaptcha-response'))
            <p class="help-block">
                {{ $errors->first('g-recaptcha-response') }}
            </p>
            @endif
        </div>
        <div class="form-group d-flex flex-wrap flex-center mt-5">
            <button type="submit" class="btn btn-primary font-size-lg font-weight-bold m-link text-uppercase px-9 py-4 my-3 btn-block">
                {{ trans('global.reset_password') }}
            </button>
        </div>
    </form>
    <div class="mt-10">
        <span class="opacity-85 mr-4 font-size-lg">{{ trans('global.you_have_account') }}</span>
        <a href="{{ route('login') }}" class="text-hover-primary font-weight-bold font-size-lg" title="{{ trans('global.login') }}">
            {{ trans('global.login') }}
        </a>
    </div>
</div>
<!--end::Login Sign up form-->
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
    $(".toggle-confirm-password").click(function () {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endsection
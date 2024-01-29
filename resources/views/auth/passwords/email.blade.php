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
        <div class="font-weight-bold font-size-lg opacity-55">{{ trans('global.send_password_title') }}</div>
    </div>

    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="form">
        @csrf
        <div class="form-group mb-5 {{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-5 font-size-lg maxlength" maxlength="150" name="email" autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">
            @if($errors->has('email'))
            <span class="help-block" role="alert">
                {{ $errors->first('email') }}
            </span>
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
        <div class="form-group d-flex flex-wrap flex-center mt-5">
            <button type="submit" class="btn btn-primary font-size-lg font-weight-bold m-link text-uppercase px-9 py-4 my-3 btn-block">
                {{ trans('global.send_password') }}
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
@endsection

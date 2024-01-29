@extends('admin.layouts.auth')
@section('styles')
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
        <h3 class="opacity-85">{{ __('global.two_factor.title') }}</h3>
        <div class="font-weight-bold font-size-lg opacity-55">{{ __('global.two_factor.sub_title', ['minutes' => 15]) }}</div>
    </div>

    @if(session()->has('message'))
    <p class="alert alert-success">
        {{ session()->get('message') }}
    </p>
    @endif

    <form method="POST" action="{{ route('twoFactor.check') }}" class="form">
        @csrf
        <div class="input-group mb-5 {{ $errors->has('two_factor_code') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>
            </div>
            <input name="two_factor_code" type="text" class="form-control h-auto form-control-solid py-4 px-5 font-size-lg {{ $errors->has('two_factor_code') ? 'is-invalid' : '' }}" autofocus placeholder="{{ trans('global.two_factor.code') }}">
            @if($errors->has('two_factor_code'))
            <span class="help-block" role="alert">
                {{ $errors->first('two_factor_code') }}
            </span>
            @endif
        </div>

        <div class="row">
            <div class="col-12 mb-5">
                <button type="submit" class="btn btn-primary font-size-lg font-weight-bold m-link text-uppercase px-9 py-4 my-3 btn-block">
                    {{ trans('global.two_factor.verify') }}
                </button>
            </div>
            <div class="col-6 text-left">
                <a class="btn btn-secondary px-4 btn-block" href="{{ route('twoFactor.resend') }}">{{ __('global.two_factor.resend') }}</a>
            </div>    
            <div class="col-6 text-right">
                <a class="btn btn-danger px-4 btn-block" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    {{ trans('global.logout') }}
                </a>
            </div>
        </div>
    </form>
    <div class="mt-10">
        <span class="opacity-85 mr-4 font-size-lg">{{ trans('global.you_have_account') }}</span>
        <a href="{{ route('login') }}" class="text-hover-primary font-weight-bold font-size-lg" title="{{ trans('global.login') }}">
            {{ trans('global.login') }}
        </a>
    </div>
</div>

<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<!--end::Login Sign up form-->
@endsection
@section('scripts')
@endsection
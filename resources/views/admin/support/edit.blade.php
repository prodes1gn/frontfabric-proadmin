@extends('admin.layouts.admin')
@section('styles')
@parent
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <div class="card-title">
            <h3 class="card-label">
                {{ $title }}
                <small>{{ $task }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("admin.support.update") }}" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body pt-0 pb-5">
            @csrf
            <div class="form-group">
                <label>{{ trans("global.customer_support_number") }}</label>
                <input class="form-control" disabled="disabled" placeholder="{{ uniqid('#') }}" />
                <input type="hidden" name="number" value="{{ uniqid('#') }}">
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label class="required" for="title">{{ trans('global.title') }} <span class="required">*</span></label>
                <input class="form-control form-control-solid maxlength" maxlength="100" type="title" name="title" value="{{ old('title', '') }}" placeholder="{{ trans('global.enter') }} {{ trans('global.title') }}">
                @if($errors->has('title'))
                <span class="help-block" permission="alert">
                    @foreach($errors->get('title') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                <label class="required" for="text">{{ trans('global.text') }} <span class="required">*</span></label>
                <textarea class="form-control form-control-solid maxlength" maxlength="1000" rows="3" name="text" placeholder="{{ trans('global.enter') }} {{ trans('global.text') }}">{{ old('text') }}</textarea>
                @if($errors->has('text'))
                <span class="help-block" permission="alert">
                    @foreach($errors->get('text') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
                <a type="submit" href="{{ route("admin.dashboard") }}" class="btn btn-secondary font-weight-bold">
                    <i class="fas fa-angle-double-left"></i>
                    {{ trans('global.back') }}
                </a>
                <button type="submit" class="btn btn-primary font-weight-bold float-right">
                    <i class="la la-send"></i>
                    {{ trans('global.send') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
@parent
@endsection
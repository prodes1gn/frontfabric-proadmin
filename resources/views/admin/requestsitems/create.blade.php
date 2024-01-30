@extends('admin.layouts.admin')
@section('styles')
@parent
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                @if(CMS::isMulitLang())
                <img src="{{ asset('uploads/settings/languages/' . mb_strtolower($lang, 'UTF-8') . '.png') }}" class="h-30px w-30px mb-1" alt="{{ strtoupper($lang) }}" />
                @endif
                {{ trans('cruds.requestsitem') }}
                <small>{{ $task }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("admin.requestsitems.store") }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lang" value="{{ $lang }}">
        <input type="hidden" name="order" value="1">
        <!--begin::Body-->
        <div class="card-body pb-5 row">
            <div class="col-lg-8">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">{{ trans('cruds.name') }} <span class="required">*</span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="150" type="text" name="name" value="{{ old('name', '') }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.name') }}">
                    @if($errors->has('name'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('name') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div> 
                <!--CRUD-FIELD-TEXT-START-->
                <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                    <label for="text">{{ trans('cruds.text') }} <span class="required">*</span></label>
                    <textarea class="form-control form-control-solid tynimce" maxlength="100000" name="text" rows="3" placeholder="{{ trans('global.enter') }} {{ trans('cruds.text') }}">{{ old('text', '') }}</textarea>
                    @if($errors->has('text'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('text') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
                <!--CRUD-FIELD-TEXT-END-->
                <!--CRUD-NEW-LANG-FIELD-->
            </div>
            <div class="col-lg-4">
                <!--CRUD-NEW-FIELD-->
            </div>
            <!--CRUD-SEO-MODULE-->
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
                <a type="submit" href="{{ route("admin.requestsitems.index") }}" class="btn btn-secondary font-weight-bold">
                    <i class="fas fa-angle-double-left"></i>
                    {{ trans('global.back') }}
                </a>
                <button type="submit" class="btn btn-primary font-weight-bold float-right">
                    <i class="far fa-save"></i>
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<!--CRUD-NEW-FIELD-JS-->
@parent
@endsection
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
                {{ trans('global.role') }}
                <small>{{ $task }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body pb-5 row">
            <div class="col-lg-8">
                @csrf
                <input type="hidden" name="lang" value="{{ $lang }}">
                <input type="hidden" name="order" value="0">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">{{ trans('cruds.title') }} <span class="required">*</span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="50" type="text" name="title" value="{{ old('title', '') }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.title') }}">
                    @if($errors->has('title'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('title') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div> 
            </div>
            <div class="col-lg-4">
                <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                    <label for="permissions">{{ trans('global.permissions') }} <span class="required">*</span></label>
                    <select class="form-control form-control-solid select2 select2_multiselect" name="permissions[]" multiple>
                        @foreach($permissions as $id => $permission)
                        <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('permissions'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('permissions') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
                <a type="submit" href="{{ route("admin.roles.index") }}" class="btn btn-secondary font-weight-bold">
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
@parent
@endsection

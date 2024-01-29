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
                {{ trans('global.my_profile') }}
                <small>{{ trans('global.edit') }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("profile.password.updateProfile") }}" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body pt-0 pb-5">
            @csrf
            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label for="avatar">{{ trans('global.avatar') }} </label><br/>
                <div class="image-input image-input-outline" id="kt_image_1">
                    <div class="image-input-wrapper" style="background-image: url({{ CMS::img(auth()->user(), 'avatar') }}); width: 200px;height: 200px;object-fit: cover;"></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('global.change') }} {{ trans('global.avatar') }}">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar" />
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="{{ trans('global.delete') }} {{ trans('global.avatar') }}">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                    @if($errors->has('avatar'))
                    <span class="help-block" permission="alert">
                        @foreach($errors->get('avatar') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.name') }} <span class="required">*</span></label>
                <input class="form-control form-control-solid maxlength" maxlength="50" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.name') }}">
                @if($errors->has('name'))
                <span class="help-block" permission="alert">
                    @foreach($errors->get('name') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('global.email') }} <span class="required">*</span></label>
                <input class="form-control form-control-solid maxlength" maxlength="150" type="text" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="{{ trans('global.enter') }} {{ trans('global.email') }}">
                @if($errors->has('email'))
                <span class="help-block" permission="alert">
                    @foreach($errors->get('email') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
                <a type="submit" href="{{ route("admin.users.index") }}" class="btn btn-secondary font-weight-bold">
                    <i class="fas fa-undo"></i>
                    {{ trans('global.back') }}
                </a>
                <button type="submit" name="action" value="1" class="btn btn-primary font-weight-bold float-right">
                    <i class="fas fa-check"></i>
                    {{ trans('global.edit') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
@parent
@endsection
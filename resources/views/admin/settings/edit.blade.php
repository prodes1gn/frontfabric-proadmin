@extends('admin.layouts.admin')
@section('styles')
@parent
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header mb-10">
        <div class="card-title">
            <h3 class="card-label">
                {{ $title }}
                <small>{{ $task }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("admin.settings.update") }}" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body pt-0 pb-5">
            @csrf
            <div class="form-group {{ $errors->has('pagination') ? 'has-error' : '' }}">
                <label class="required" for="pagination">{{ trans('global.pagination') }} <span class="required">*</span></label>
                <input class="form-control form-control-solid touchspin_pagination" type="text" name="pagination" value="{{ old('pagination', Setting::get('pagination')) }}" placeholder="{{ trans('global.enter') }} {{ trans('global.pagination') }}">
                @if($errors->has('pagination'))
                <span class="help-block" permission="alert">
                    @foreach($errors->get('pagination') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('theme_aside_enable') ? 'has-error' : '' }}">
                <label for="theme_aside_enable" style="font-weight: 400">{{ trans('global.theme_aside_enable') }}</label>
                <div>
                    <input type="hidden" name="theme_aside_enable" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="theme_aside_enable" value="1" {{ Setting::get('theme_aside_enable') || old('theme_aside_enable', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('theme_aside_enable'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('theme_aside_enable') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('theme_header_menu') ? 'has-error' : '' }}">
                <label for="theme_header_menu">{{ trans('global.theme_header_menu') }}</label>
                <div>
                    <input type="hidden" name="theme_header_menu" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="theme_header_menu" value="1" {{ Setting::get('theme_header_menu') || old('theme_header_menu', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('theme_header_menu'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('theme_header_menu') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('aside_minimize') ? 'has-error' : '' }}">
                <label for="aside_minimize">{{ trans('global.aside_minimize') }}</label>
                <div>
                    <input type="hidden" name="aside_minimize" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="aside_minimize" value="1" {{ Setting::get('aside_minimize') || old('aside_minimize', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('aside_minimize'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('aside_minimize') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('theme_breadcrumbs') ? 'has-error' : '' }}">
                <label for="theme_breadcrumbs">{{ trans('global.theme_breadcrumbs') }}</label>
                <div>
                    <input type="hidden" name="theme_breadcrumbs" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="theme_breadcrumbs" value="1" {{ Setting::get('theme_breadcrumbs') || old('theme_breadcrumbs', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('theme_breadcrumbs'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('theme_breadcrumbs') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('theme_header') ? 'has-error' : '' }}">
                <label for="theme_header">{{ trans('global.theme_header') }}</label>
                <select class="form-control select2 select2_dropdown" name="theme_header">
                    <?php
                    $theme_header = ['light' => 'light', 'dark' => 'dark'];
                    ?>
                    @foreach ($theme_header as $k => $v)
                    <option value="{{ $k }}" {{ old('status', Setting::get('theme_header')) == $k ? "selected" : ""}}>
                        {{ $v }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group {{ $errors->has('theme_aside') ? 'has-error' : '' }}">
                <label for="theme_aside">{{ trans('global.theme_aside') }}</label>
                <select class="form-control select2 select2_dropdown" name="theme_aside">
                    <?php
                    $theme_aside = ['light' => 'light', 'dark' => 'dark'];
                    ?>
                    @foreach ($theme_aside as $k => $v)
                    <option value="{{ $k }}" {{ old('status', Setting::get('theme_aside')) == $k ? "selected" : ""}}>
                        {{ $v }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group {{ $errors->has('twofa_by_email') ? 'has-error' : '' }}">
                <label for="twofa_by_email">{{ trans('global.twofa_by_email') }}</label>
                <div>
                    <input type="hidden" name="twofa_by_email" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="twofa_by_email" value="1" {{ Setting::get('twofa_by_email') || old('twofa_by_email', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('twofa_by_email'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('twofa_by_email') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('gmaps_key') ? 'has-error' : '' }}">
                <label for="gmaps_key">{{ trans('global.gmaps_key') }}</label>
                <input class="form-control form-control-solid maxlength" maxlength="255" type="text" name="gmaps_key" value="{{ old('gmaps_key', Setting::get('gmaps_key')) }}" placeholder="{{ trans('global.enter') }} {{ trans('global.gmaps_key') }}">
                @if($errors->has('gmaps_key'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('gmaps_key') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
                <button type="submit" class="btn btn-primary font-weight-bold float-right">
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
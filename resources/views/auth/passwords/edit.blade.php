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
                {{ trans('global.change_password') }}
                <small>{{ trans('global.edit') }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("profile.password.update") }}">
        <!--begin::Body-->
        <div class="card-body pt-0 pb-5">
            @csrf
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label class="required" for="password">{{ trans('global.new_password') }} <span class="required">*</span></label>
                <div class="input-group">
                    <input class="form-control form-control-solid maxlength" maxlength="{{ config('cms.password_max_chars') }}" type="password" name="password" value="" id="password-field" placeholder="{{ trans('global.enter') }} {{ trans('global.new_password') }}">
                    <div class="input-group-append">
                        <a href="javascript:;" data-repeater-delete="" class="input-group-text">
                            <i class="fa fa-lg fa-eye-slash field-icon toggle-password" toggle="#password-field"></i>
                        </a>
                    </div>
                </div>
                @if($errors->has('password'))
                <span class="help-block" permission="alert">
                    @foreach($errors->get('password') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="password_confirmation">{{ trans('global.repeat_new_password') }} <span class="required">*</span></label>
                <div class="input-group">
                    <input class="form-control form-control-solid maxlength" maxlength="{{ config('cms.password_max_chars') }}" type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ trans('global.repeat_new_password') }}">
                    <div class="input-group-append">
                        <a href="javascript:;" data-repeater-delete="" class="input-group-text">
                            <i class="fa fa-lg fa-eye-slash field-icon toggle-password" toggle="#password_confirmation"></i>
                        </a>
                    </div>
                </div>
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
    $(".password_confirmation").click(function () {
        $(this).toggleClass("fa-eye-slash fa-eye");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@parent
@endsection
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
                {{ trans('global.user') }}
                <small>{{ trans('global.edit') }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body pb-5">
            @method('PUT')
            @csrf
            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label for="avatar">{{ trans('global.avatar') }} </label><br/>
                <div class="image-input image-input-outline" id="kt_image_1">
                    <div class="image-input-wrapper" style="background-image: url({{ CMS::img($user, 'avatar') }}); width: 200px;height: 200px;object-fit: cover;"></div>
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
                <input class="form-control form-control-solid maxlength" maxlength="50" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.name') }}">
                @if($errors->has('name'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('name') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('global.email') }} <span class="required">*</span></label>
                <input class="form-control form-control-solid maxlength" maxlength="150" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="{{ trans('global.enter') }} {{ trans('global.email') }}">
                @if($errors->has('email'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('email') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('global.password') }}</label>
                <input class="form-control form-control-solid maxlength" maxlength="{{ config('cms.password_max_chars') }}" type="password" name="password" placeholder="{{ trans('global.enter') }} {{ trans('global.password') }}">
                @if($errors->has('password'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('password') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('approved') ? 'has-error' : '' }}">
                <label for="approved" style="font-weight: 400">{{ trans('global.approved') }}</label>
                <div>
                    <input type="hidden" name="approved" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="approved" value="1" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('approved'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('approved') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('verified') ? 'has-error' : '' }}">
                <label for="verified" style="font-weight: 400">{{ trans('global.verified') }}</label>
                <div>
                    <input type="hidden" name="verified" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="verified" value="1" {{ $user->verified || old('verified', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('verified'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('verified') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('global.roles') }} <span class="required">*</span></label>
                <select class="form-control select2 select2_multiselect" name="roles[]" multiple>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ (in_array($role->id, old('roles', [])) || $user->roles->contains($role->id)) ? 'selected' : '' }}>{{ $role->translateOrDefault($lang)->title }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('roles') as $message)
                    {{ $message }}<br />
                    @endforeach
                </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status" style="font-weight: 400">{{ trans('global.status') }}</label>
                <div>
                    <input type="hidden" name="status" value="0">
                    <input data-switch="true" data-size="small" type="checkbox" data-on-color="success" data-on-text="{{ trans('global.yes') }}" data-off-color="danger" data-off-text="{{ trans('global.no') }}" name="status" value="1" {{ $user->status || old('status', 0) === 1 ? 'checked' : '' }}/>
                </div>
                @if($errors->has('status'))
                <span class="help-block" role="alert">
                    @foreach($errors->get('status') as $message)
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
                    <i class="fas fa-angle-double-left"></i>
                    {{ trans('global.back') }}
                </a>
                <button type="submit" class="btn btn-primary font-weight-bold float-right">
                    <i class="far fa-save"></i>
                    {{ trans('global.save') }}
                </button>
                <button type="submit" name="action" value="1" class="btn btn-primary font-weight-bold float-right mr-5">
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
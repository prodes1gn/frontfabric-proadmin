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
                <small>{{ trans('global.show') }}</small>
            </h3>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pb-5">
        <!--begin::Table-->
        <div class="table-responsive table-striped table-hover">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.id') }}
                    </th>
                    <td>
                        {{ $user->id }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.avatar') }}
                    </th>
                    <td>
                        <img src="{{ CMS::img($user, 'avatar', true) }}" height="100px;">
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.name') }}
                    </th>
                    <td>
                        {{ $user->name }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.email') }}
                    </th>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.email_verified_at') }}
                    </th>
                    <td>
                        {{ $user->email_verified_at }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.approved') }}
                    </th>
                    <td>
                        @if($user->approved)
                        <input data-switch="true" data-size="small"  type="checkbox" checked="checked" disabled="disabled" data-on-color="success" data-on-text="{{ trans('global.yes') }}" />
                        @else
                        <input data-switch="true" data-size="small" type="checkbox" disabled="disabled" data-off-color="danger" data-off-text="{{ trans('global.no') }}" />
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.verified') }}
                    </th>
                    <td>
                        @if($user->verified)
                        <input data-switch="true" data-size="small"  type="checkbox" checked="checked" disabled="disabled" data-on-color="success" data-on-text="{{ trans('global.yes') }}" />
                        @else
                        <input data-switch="true" data-size="small" type="checkbox" disabled="disabled" data-off-color="danger" data-off-text="{{ trans('global.no') }}" />
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.status') }}
                    </th>
                    <td>
                        @if($user->status)
                        <input data-switch="true" data-size="small"  type="checkbox" checked="checked" disabled="disabled" data-on-color="success" data-on-text="{{ trans('global.yes') }}" />
                        @else
                        <input data-switch="true" data-size="small" type="checkbox" disabled="disabled" data-off-color="danger" data-off-text="{{ trans('global.no') }}" />
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('global.roles') }}
                    </th>
                    <td>
                        @foreach($user->roles as $key => $roles)
                        <span class="label label-primary label-inline font-weight-bold mr-2">{{ $roles->title }}</span>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
    <div class="card-footer d-flex justify-content-between">
        <div class="form-group-show">
            <a class="btn btn-secondary font-weight-bold" href="{{ route('admin.users.index') }}">
                <i class="fas fa-angle-double-left"></i>
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
@endsection
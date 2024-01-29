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
                {{ trans('cruds.systempagesitem') }}
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
                        {{ $systempagesitem->id }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.name') }}
                    </th>
                    <td>
                        {{ $systempagesitem->name }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SLUG START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.slug') }}
                    </th>
                    <td>
                        {{ $systempagesitem->slug }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SLUG END-->
                <!--CRUD-FIELD-SEOTITLE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seotitle') }}
                    </th>
                    <td>
                        {{ $systempagesitem->seotitle }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SEOTITLE END-->
                <!--CRUD-FIELD-SEODESCRIPTION START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seodescription') }}
                    </th>
                    <td>
                        {{ $systempagesitem->seodescription }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SEODESCRIPTION END-->
                <!--CRUD-FIELD-SEOIMAGE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seoimage') }}
                    </th>
                    <td>
                        <img src="{{ CMS::img($systempagesitem, 'seoimage', true) }}" height="100px;">
                    </td>
                </tr>
                <!--CRUD-FIELD-SEOIMAGE END-->
                <!--CRUD-FIELD-SEOTYPE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seotype') }}
                    </th>
                    <td>
                        @if(is_array($seotypes) && isset($seotypes[$systempagesitem->seotype]))
                        {{ $seotypes[$systempagesitem->seotype] }}
                        @else
                        -
                        @endif
                    </td>
                </tr>
                <!--CRUD-FIELD-SEOTYPE END-->
                <!--CRUD-NEW-FIELD-->
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
    <div class="card-footer d-flex justify-content-between">
        <div class="form-group-show">
            <a class="btn btn-secondary font-weight-bold" href="{{ route('admin.systempagesitems.index') }}">
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
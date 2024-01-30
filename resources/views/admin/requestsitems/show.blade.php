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
                {{ trans('cruds.requestsitem') }}
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
                        {{ $requestsitem->id }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.name') }}
                    </th>
                    <td>
                        {{ $requestsitem->name }}
                    </td>
                </tr>
                <!--CRUD-FIELD-TEXT START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.text') }}
                    </th>
                    <td>
                        {!! $requestsitem->text !!}
                    </td>
                </tr>
                <!--CRUD-FIELD-TEXT END-->
                <!--CRUD-NEW-FIELD-->
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
    <div class="card-footer d-flex justify-content-between">
        <div class="form-group-show">
            <a class="btn btn-secondary font-weight-bold" href="{{ route('admin.requestsitems.index') }}">
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
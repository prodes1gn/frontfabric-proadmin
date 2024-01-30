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
                {{ trans('cruds.serviceitem') }}
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
                        {{ $serviceitem->id }}
                    </td>
                </tr>
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.name') }}
                    </th>
                    <td>
                        {{ $serviceitem->name }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SLUG START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.slug') }}
                    </th>
                    <td>
                        {{ $serviceitem->slug }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SLUG END-->
                <!--CRUD-FIELD-SEOTITLE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seotitle') }}
                    </th>
                    <td>
                        {{ $serviceitem->seotitle }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SEOTITLE END-->
                <!--CRUD-FIELD-SEODESCRIPTION START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seodescription') }}
                    </th>
                    <td>
                        {{ $serviceitem->seodescription }}
                    </td>
                </tr>
                <!--CRUD-FIELD-SEODESCRIPTION END-->
                <!--CRUD-FIELD-SEOIMAGE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seoimage') }}
                    </th>
                    <td>
                        <img src="{{ CMS::img($serviceitem, 'seoimage', true) }}" height="100px;">
                    </td>
                </tr>
                <!--CRUD-FIELD-SEOIMAGE END-->
                <!--CRUD-FIELD-SEOTYPE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.seotype') }}
                    </th>
                    <td>
                        @if(is_array($seotypes) && isset($seotypes[$serviceitem->seotype]))
                        {{ $seotypes[$serviceitem->seotype] }}
                        @else
                        -
                        @endif
                    </td>
                </tr>
                <!--CRUD-FIELD-SEOTYPE END-->
                <!--CRUD-FIELD-HOMETEXT START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.hometext') }}
                    </th>
                    <td>
                        {{ $serviceitem->hometext }}
                    </td>
                </tr>
                <!--CRUD-FIELD-HOMETEXT END-->
                <!--CRUD-FIELD-TEXT START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.text') }}
                    </th>
                    <td>
                        {!! $serviceitem->text !!}
                    </td>
                </tr>
                <!--CRUD-FIELD-TEXT END-->
                <!--CRUD-FIELD-SERVICEPOINTDROPDOWN START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.servicepointdropdown') }}
                    </th>
                    <td>
                        @foreach($serviceitem->servicepointdropdown as $row)
                        <span class="label label-primary label-inline font-weight-bold mr-2">{{ $row->name }}</span>
                        @endforeach
                    </td>
                </tr>
                <!--CRUD-FIELD-SERVICEPOINTDROPDOWN END-->
                <!--CRUD-FIELD-IMAGE START-->
                <tr>
                    <th style="width:20%;" class="text-right">
                        {{ trans('cruds.image') }}
                    </th>
                    <td>
                        <img src="{{ CMS::img($serviceitem, 'image', true) }}" height="100px;">
                    </td>
                </tr>
                <!--CRUD-FIELD-IMAGE END-->
                <!--CRUD-NEW-FIELD-->
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
    <div class="card-footer d-flex justify-content-between">
        <div class="form-group-show">
            <a class="btn btn-secondary font-weight-bold" href="{{ route('admin.serviceitems.index') }}">
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
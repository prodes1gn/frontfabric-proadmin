@extends('admin.layouts.admin')
@section('styles')
<style>
    .search-dashboard .select2-container--default .select2-selection--single,
    .search-dashboard .select2-container--default .select2-selection--multiple {
        border: none !important;
        background: inherit !important;
    }
    .select2-results__option:hover {
        background-color: #EEF0F8;
        cursor: pointer;
    }
    .searchable-title {
        font-weight: bold;
    }
    .searchable-fields {
        margin-left: 10px;
        font-style: italic;
    }
    .search-dashboard {
        border: 1px solid #dddddd;
    }
</style>
@parent
@endsection
@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-xl-8">
        <div class="row">

            <!--begin::Engage Widget 15-->

            <div class="col-xl-12">
                <div class="card card-custom mb-8">
                    <div class="card-body rounded p-0 d-flex">
                        <div class="d-flex col-sm-12 flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-650px py-10 py-md-14 px-10 px-md-20 pr-lg-0">
                            <h1 class="font-weight-bolder text-dark">{{ trans('global.searching') }}</h1>
                            <div class="font-size-h4 mb-8">{{ trans('global.fast_searching') }}</div>
                            <!--begin::Form-->
                            <form class="d-flex flex-center py-2 px-6 bg-light rounded search-dashboard">
                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <select class="searchable-field form-control">

                                </select>
                            </form>
                            <!--end::Form-->
                        </div>
                        <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-image: url(assets/media/svg/illustrations/copy.svg);"></div>
                    </div>
                </div>
            </div>
            <!--end::Engage Widget 15-->


            <div class="col-xl-12">               
                <!--begin::Callout-->
                <div class="card card-custom mb-5">
                    <div class="alert alert-custom alert-primary mb-0 px-5 py-3">
                        <div class="alert-icon">
                            <i class="la la-link"></i>
                        </div>
                        <div class="d-flex flex-column mr-5">
                            <p class="h4 text-white m-0">{{ trans('global.fast_add') }}</p>
                            <p class="text-white m-0">{{ trans('global.fast_add_info') }}</p>
                        </div>
                    </div>
                </div>
                <!--end::Callout-->
            </div>

            <!--begin::Add Users-->
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('global.user') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('global.users') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Add Users-->

            <!--begin::Add Roles-->
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('global.role') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('global.roles') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Add Roles-->

            <!--CRUD-ITEM-SERVICEITEM-START-->
            @can('serviceitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.serviceitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.serviceitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.serviceitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-SERVICEITEM-END-->
            @endcan

            <!--CRUD-ITEM-WHYUSHOMEPAGEITEM-START-->
            @can('whyushomepageitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.whyushomepageitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.whyushomepageitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.whyushomepageitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-WHYUSHOMEPAGEITEM-END-->
            @endcan

            <!--CRUD-ITEM-TESTIMONIALSITEM-START-->
            @can('testimonialsitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.testimonialsitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.testimonialsitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.testimonialsitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-TESTIMONIALSITEM-END-->
            @endcan

            <!--CRUD-ITEM-APPPROACHITEM-START-->
            @can('appproachitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.appproachitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.appproachitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.appproachitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-APPPROACHITEM-END-->
            @endcan

            <!--CRUD-ITEM-PORTFOLIOITEM-START-->
            @can('portfolioitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.portfolioitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.portfolioitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.portfolioitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-PORTFOLIOITEM-END-->
            @endcan

            <!--CRUD-ITEM-BLOGITEM-START-->
            @can('blogitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.blogitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.blogitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.blogitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-BLOGITEM-END-->
            @endcan

            <!--CRUD-ITEM-REQUESTSITEM-START-->
            @can('requestsitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.requestsitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.requestsitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.requestsitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-REQUESTSITEM-END-->
            @endcan

            <!--CRUD-ITEM-SYSTEMPAGESITEM-START-->
            @can('systempagesitem_create')
            <div class="col-xl-6 fast-buttons">
                <div class="card card-custom mb-5 bgi-no-repeat" style="background-position: left top; background-size: 100% auto; background-image: url({{ 'assets/media/svg/shapes/abstract-2.svg'}})">	
                    <div class="card-body py-2 px-5">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <p class="h4 text-primary mb-2">
                                    {{ trans('global.create') }} {{ trans('cruds.systempagesitem') }}
                                </p>
                                <p class="text-dark-50" mb-0">
                                    {{ trans('global.fast_add_text') }} {{ trans('cruds.systempagesitems') }}
                                </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.systempagesitems.create') }}" class="btn btn-primary font-weight-bold">
                                    <i class="fas fa-plus-circle"></i>
                                    {{ trans('global.add') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--CRUD-ITEM-SYSTEMPAGESITEM-END-->
            @endcan

            <!--CRUD-NEW-ITEM-->
        </div>

        <div class="row">

            <div class="col-xl-12">               
                <!--begin::Callout-->
                <div class="card card-custom mb-5">
                    <div class="alert alert-custom alert-danger mb-0 px-5 py-3">
                        <div class="alert-icon">
                            <i class="la la-gear"></i>
                        </div>
                        <div class="d-flex flex-column mr-5">
                            <p class="h4 text-white m-0">{{ trans('global.settings') }}</p>
                            <p class="text-white m-0">{{ trans('global.settings_info') }}</p>
                        </div>
                    </div>
                </div>
                <!--end::Callout-->
            </div>

            <div class="col-xl-12">   
                <!--begin::Card-->
                <div class="card card-custom example example-compact gutter-b">
                    <div class="card-body">
                        <!--begin::Nav Tabs-->
                        <ul class="dashboard-tabs nav nav-pills nav-danger row row-paddingless m-0 p-0 flex-column flex-sm-row">

                            @can('settings_access')
                            <!--begin::Item-->
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0 bg-light">
                                <a href="{{ route("admin.settings.edit") }}" title="{{ trans('global.settings') }}" class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                                    <span class="nav-icon py-2 w-auto">
                                        <i class="la la-sliders-h text-danger"></i>
                                    </span>
                                    <span class="nav-text font-size-h5 py-2 font-weight-bold text-center mt-5">{{ trans('global.settings') }}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endcan

                            @can('user_access')
                            <!--begin::Item-->
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0 bg-light">
                                <a href="{{ route("admin.users.index") }}" title="{{ trans('global.users') }}" class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                                    <span class="nav-icon py-2 w-auto">
                                        <i class="la la-users-cog text-danger"></i>
                                    </span>
                                    <span class="nav-text font-size-h5 py-2 font-weight-bold text-center mt-5">{{ trans('global.users') }}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endcan

                            @can('translations_access')
                            <!--begin::Item-->
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0 bg-light">
                                <a href="{{ route('languages.translations.index', config('app.locale')) }}" title="{{ trans('global.translations') }}" class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                                    <span class="nav-icon py-2 w-auto">
                                        <i class="la la-language text-danger"></i>
                                    </span>
                                    <span class="nav-text font-size-h5 py-2 font-weight-bold text-center mt-5">{{ trans('global.translations') }}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endcan

                            @can('filemanager_access')
                            <!--begin::Item-->
                            <li class="nav-item d-flex col-sm flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0 bg-light">
                                <a href="{{ route("elfinder.index") }}" title="{{ trans('global.filemanager') }}" class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center">
                                    <span class="nav-icon py-2 w-auto">
                                        <i class="la la-folder-open text-danger"></i>
                                    </span>
                                    <span class="nav-text font-size-h5 py-2 font-weight-bold text-center mt-5">{{ trans('global.filemanager') }}</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            @endcan
                        </ul>
                        <!--end::Nav Tabs-->

                    </div>
                </div>
                <!--end::Card-->
            </div>

        </div>

    </div>
    <div class="col-xl-4">
        <div class="row">

            <div class="col-xl-12 mb-5">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title m-0">
                            <h3 class="card-label m-0">{{ trans('global.last_user_activity') }}</h3>
                        </div>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="scroll scroll-pull" data-scroll="true" style="height: 300px">
                            <!--begin::Example-->
                            <div class="example example-basic">
                                <!--begin::Timeline-->
                                <div class="timeline timeline-6 mt-3">

                                    @foreach($activity_log as $log)
                                    <!--begin::Item-->
                                    <div class="timeline-item align-items-start">
                                        <!--begin::Label-->
                                        <div class="timeline-label font-weight-bold text-dark-75 font-size-lg">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $log->created_at)->format('d.m H:i'); }}
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            @switch($log->type)
                                            @case("DELETE")
                                            <i class="fa fa-genderless text-danger icon-xl"></i>
                                            @break
                                            @case("POST")
                                            <i class="fa fa-genderless text-warning icon-xl"></i>
                                            @break
                                            @case("PUT")
                                            <i class="fa fa-genderless text-primary icon-xl"></i>
                                            @break
                                            @default
                                            <i class="fa fa-genderless text-secondary icon-xl"></i>
                                            @endswitch
                                        </div>
                                        <!--end::Badge-->
                                        <!--begin::Text-->
                                        <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 font-weight-bold"">
                                            <span>
                                                {{ $log->user->name }}
                                            </span>
                                            @switch($log->type)
                                            @case("DELETE")
                                            <span class="text-danger">
                                                {{ trans('global.delete') }}
                                            </span>
                                            @break
                                            @case("POST")
                                            <span class="text-warning">
                                                {{ trans('global.edit') }}
                                            </span>
                                            @break
                                            @case("PUT")
                                            <span class="text-primary">
                                                {{ trans('global.edit') }}
                                            </span>
                                            @break
                                            @default
                                            <span class="text-secondary">
                                                {{ trans('global.view') }}
                                            </span>
                                            @endswitch
                                            <span class="font-italic">
                                                {{ $log->url }}
                                            </span>
                                        </div>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Item-->
                                    @endforeach

                                </div>
                                <!--end::Timeline-->
                            </div>
                            <!--end::Example-->
                        </div>
                    </div>
                </div>
                <!--end::Card-->

            </div>

            @if(config('cms.support'))
            <div class="col-xl-12">
                <!--begin::Callout-->
                <div class="card card-custom mb-2 bg-diagonal bg-diagonal-light-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                            <div class="d-flex flex-column mr-5">
                                <span class="h4 text-dark mb-5">{{ trans('global.customer_support_title') }}</span>
                                <p class="text-dark-50">{{ trans('global.customer_support_info') }}</p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a href="{{ route('admin.support.edit') }}" class="btn font-weight-bolder text-uppercase btn-success py-4 px-6">
                                    {{ trans('global.customer_support_button') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Callout-->
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
    $('.searchable-field').select2({
    minimumInputLength: 3,
            ajax: {
            url: '{{ route("admin.globalSearch") }}',
                    dataType: 'json',
                    type: 'GET',
                    delay: 200,
                    data: function (term) {
                    return {
                    search: term
                    };
                    },
                    results: function (data) {
                    return {
                    data
                    };
                    }
            },
            escapeMarkup: function (markup) { return markup; },
            templateResult: formatItem,
            templateSelection: formatItemSelection,
            placeholder : '{{ trans('global.search') }}...',
            language: {
            inputTooShort: function(args) {
            var remainingChars = args.minimum - args.input.length;
            var translation = '{{ trans('global.search_input_too_short') }}';
            return translation.replace(':count', remainingChars);
            },
                    errorLoading: function() {
                    return '{{ trans('global.results_could_not_be_loaded') }}';
                    },
                    searching: function() {
                    return '{{ trans('global.searching') }}';
                    },
                    noResults: function() {
                    return '{{ trans('global.no_results') }}';
                    },
            }

    });
    function formatItem (item) {
    if (item.loading) {
    return '{{ trans('global.searching') }}...';
    }
    var markup = "<div class='searchable-link' href='" + item.url + "'>";
    markup += "<div class='searchable-title'>" + item.model + "</div>";
    $.each(item.fields, function(key, field) {
    markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
    });
    markup += "</div>";
    return markup;
    }

    function formatItemSelection (item) {
    if (!item.model) {
    return '{{ trans('global.search') }}...';
    }
    return item.model;
    }
    $(document).delegate('.searchable-link', 'click', function() {
    var url = $(this).attr('href');
    window.location = url;
    });
    });

</script>
@parent
@endsection
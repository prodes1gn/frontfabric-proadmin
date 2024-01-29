<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5">{{ isset($title) ? $title : '' }}</h5>
                <!--end::Page Title-->
                @if(!request()->is(config('cms.admin_panel_url')))
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route("admin.dashboard") }}" title="{{ trans('global.dashboard') }}" class="text-muted">{{ trans('global.dashboard') }}</a>
                    </li>
                    @if(isset($title))
                    <li class="breadcrumb-item text-muted">
                        <span class="text-muted">{{ isset($title) ? $title : '' }}</span>
                    </li>
                    @endif
                    @if(isset($task))
                    <li class="breadcrumb-item text-muted">
                        <span class="text-muted">{{ $task }}</span>
                    </li>
                    @endif
                </ul>
                <!--end::Breadcrumb-->
                @endif
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
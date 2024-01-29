<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <a href="{{ config('cms.developer_url') }}" target="_blank" class="text-dark-75 opacity-85 font-weight-bold text-hover-primary">{{ config('cms.developer') }}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark">
            <span class="opacity-65 font-weight-bold mr-2">2023© {{ config('cms.site_title') }} </span>
            <span class="opacity-65 font-weight-bold mr-2">{{ trans('global.allRightsReserved') }} </span>
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--begin::Page Scripts(used by this page)-->
<script src="{{ config('assets/js/pages/crud/forms/widgets/bootstrap-maxlength.js')}}"></script>
<!--end::Page Scripts-->
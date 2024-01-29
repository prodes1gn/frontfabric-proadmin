<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <!--begin::Head-->
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('cms.site_title') }}</title>
        <meta name="description" content="{{ config('cms.site_title') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&subset=all" />
        <!--end::Fonts-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Page Custom Styles-->
        <link href="{{ asset('assets/css/pages/login/classic/login-4.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{ asset('assets/css/themes/layout/header/base/' . Setting::get('theme_header') . '.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/themes/layout/header/menu/' . Setting::get('theme_header') . '.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/themes/layout/brand/' . Setting::get('theme_aside') . '.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/themes/layout/aside/' . Setting::get('theme_aside') . '.css') }}" rel="stylesheet" type="text/css" />
        <!--begin::Custom Styles-->  
        @yield('styles')
        <!--end::Custom Styles-->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    </head>
    <!--end::Head-->

    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed {{ (Setting::get('theme_breadcrumbs') != 0) ? 'subheader-enabled' : '' }} {{ (Setting::get('theme_aside_enable') != 0) ? 'aside-enabled' : '' }} aside-fixed aside-minimize-hoverable page-loading">

        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
                <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url({{ asset('assets/media/bg/bg-3.jpg') }});">
                    <div class="login-form text-center p-7 position-relative overflow-hidden">
                        @yield('content')
                    </div>
                    <!--end::Login-->
                </div>
            </div>
        </div>
        <!--end::Main-->

        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js?v=7.2.9') }}"></script>
        <!--end::Page Scripts-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
        <!--end::Page Scripts-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-maxlength.js')}}"></script>
        <!--end::Page Scripts-->
        @yield('scripts')
    </body>
    <!--end::Body-->

</html>
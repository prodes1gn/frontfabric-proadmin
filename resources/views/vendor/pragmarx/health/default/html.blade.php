@extends('admin.layouts.admin')

@section('styles')
<script>
    window.laravel = @json($laravel)
</script>
@stop

@section('content')

<style>


    .nav-button {
        margin: 0 !important
    }

    .target-card {
        border-color: #bdbdbd !important;
        background-color: #fff
    }

    .shadow {
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1)
    }

    .color-neutral {
        color: #00f;
        background-color: #00f;
    }

    .color-success {
        color: green;
        fill: green;
    }

    .color-danger {
        color: #ffa8c4;
        fill: red;
    }

    .color-success-background {
        background-color: #d6e9c6;
    }

    .color-danger-background {
        background-color: #ffe5c4;
    }

    .info-icon {
        margin-top: 7px;
        width: 1.8em;
        opacity: .5
    }

    .chart {
        margin: 7px -50px -7px -7px;
        display: none;
    }

    #app .target-card{
        height: 100px;
        margin-bottom: 10px;
    }
    #app .title {
        font-size: 14px;
        font-weight: 600;
    }
    #app .title, #app .subtitle {
        line-height: 20px;
        padding: 0px;
        margin: 0px;
    }
    #app .row{
        padding-top: 15px;
        margin-bottom: 0px !important;
    }
    #app .form-control {
        background-color: #F2F3F7;
        border-color: #dddddd;
        color: #3F4254;
        -webkit-transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, -webkit-box-shadow 0.15s ease;
        transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, -webkit-box-shadow 0.15s ease;
        transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease, -webkit-box-shadow 0.15s ease;
    }
    #app .btn-result,  #app .form-group {
        margin-right: 10px !important;
        margin-bottom: 1rem !important;
    }
    #app {
        padding-bottom: 20px;
    }
    #app .target-card .row {
        padding-top: 0px;
    }
</style>
@yield('html.body')

@yield('html.footer')

<script>
    {!! file_get_contents(config('health.dist_path').'/js/app.js')  !!}
</script>

@if (config('app.env') == 'local')
<script src="http://localhost:35729/livereload.js"></script>
@endif
@stop

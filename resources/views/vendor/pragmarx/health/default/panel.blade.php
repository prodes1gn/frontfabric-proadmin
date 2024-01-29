@extends('pragmarx/health::default.html')
@php
$title = trans('global.health_monitor');
@endphp
@section('html.body')
    <div id="app" class="card card-custom">
        <health-panel
            :config="config"

        >
        </health-panel>
    </div>
@stop

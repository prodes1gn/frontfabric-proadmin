@extends('admin.layouts.admin')
@section('styles')
@parent
<style>
    .flex {
        display: flex
    }
    .w-1 {
        width: .25rem
    }
    .w-2 {
        width: .5rem
    }

    .w-3 {
        width: .75rem
    }
    .w-4 {
        width: 1rem
    }
    .w-5 {
        width: 1.25rem
    }
    .w-6 {
        width: 1.5rem
    }
    .w-8 {
        width: 2rem
    }
    .w-10 {
        width: 2.5rem
    }
    .card-body td textarea {
        overflow-wrap: inherit;
        border-style: none;
        resize: none;
        background-color: transparent;
        width: 100%;
        cursor: pointer;
        border-bottom: dashed 1px #3699FF;
        font-style: italic;
        overflow: hidden;
    }
    .card-body td textarea.active {
        width: 100%;
        border-radius: .25rem;
        height: 8rem;
        padding: .5rem;
        background-color: #F2F3F7;
        border: 1px solid #3699FF;
    }
    .card-body td textarea:focus {
        outline: 0
    }
    .input-group {
        width: 100%;
        margin-bottom: 1.5rem
    }
    .input-group label {
        display: block;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #606f7b;
        font-size: .75rem;
        font-weight: 700;
        margin-bottom: .5rem
    }
    .input-group input {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        display: block;
        width: 100%;
        background-color: #f1f5f8;
        color: #606f7b;
        border-width: 1px;
        border-radius: .25rem;
        padding: .75rem 1rem;
        margin-bottom: .75rem;
        line-height: 1.25
    }
    .input-group:last-child {
        margin-bottom: 0
    }
    .input-group input.error {
        border-color: #e3342f
    }
    .input-group .error-text {
        color: #e3342f;
        font-size: .75rem;
        font-style: italic
    }
    .fill-current {
        fill: currentColor;
        color: #3699FF;
    }
    .text-green {
        color: #38c172
    }
    .hover\:text-green:hover {
        color: #38c172
    }
    .focus\:text-green:focus {
        color: #38c172
    }
    .card-title {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin: 0.5rem;
        margin-left: 0;
    }
    .card-label {
        font-weight: 500;
        font-size: 1.275rem;
        color: #181C32;
    }
    .form-group {
        margin: 0rem 0rem 0rem 1rem;
    }
</style>
@endsection
@section('content')
@php
$title = trans('global.translation');
@endphp

@yield('body')

<!--end::Advance Table Widget 3-->
@endsection
@section('scripts')
<script src="{{ asset('/vendor/translation/js/app.js') }}"></script>
@parent
@endsection
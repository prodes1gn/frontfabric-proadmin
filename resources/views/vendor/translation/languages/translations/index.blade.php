@extends('translation::layout')
@section('body')
<style>
    .form-group {
        margin: 0rem 0rem 0rem 0rem;
        padding-right: 0rem;
    }
    @media (max-width: 767.98px) {
        .card.card-custom > .card-header .card-toolbar {
            width: 100%;
        }
        .form-group {
            margin: 0rem 0rem 1rem 0rem;
            padding-left: 0rem;
        }
    }
</style>
<form action="{{ route('languages.translations.index', ['language' => $language]) }}" method="get" id="app">
    <!--begin::Advance Table Widget 3-->
    <div class="card card-custom" id="kt_card_1">
        <!--begin::Header-->
        <div class="card-header mb-10">
            <div class="card-title">
                <h3 class="card-label">
                    {{ trans('global.translations') }}
                    <small>{{ trans('global.edit') }}</small>
                </h3>
            </div>
            <div class="card-toolbar row">
                @include('translation::forms.search', ['name' => 'filter', 'value' => Request::get('filter')])
                @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])
                @include('translation::forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-5">
            @if(count($translations))
            <!--begin::Table-->
            <div class="table-responsive table-striped table-hover">
                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                    <thead>
                        <tr class="text-uppercase">
                            <th style="width:5%; min-width: 50px;" class="text-center">
                                <span class="text-dark-75">
                                    {{ __('translation::translation.group_single') }}
                                </span>
                            </th>
                            <th style="width:25%; min-width: 200px;" class="text-center">
                                <span class="text-dark-75">
                                    {{ __('translation::translation.key') }}
                                </span>
                            </th>
                            <th style="width:35%; min-width: 200px;" class="text-center">
                                <span class="text-dark-75">
                                    {{ config('app.locale') }}
                                </span>
                            </th>
                            <th style="width:35%; min-width: 200px;" class="text-center">
                                <span class="text-dark-75">
                                    {{ $language }}
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($translations as $type => $items)

                        @foreach($items as $group => $translations)

                        @foreach($translations as $key => $value)

                        @if(!is_array($value[config('translatable.locale')]))
                        <tr>
                            <td class="font-weight-bold text-center">{{ $group }}</td>
                            <td class="font-weight-bold text-left">{{ $key }}</td>
                            <td class="font-weight-bold text-left">{{ $value[config('translatable.locale')] }}</td>
                            <td class="font-weight-bold text-left">
                    <translation-input 
                        initial-translation="{{ $value[$language] }}" 
                        language="{{ $language }}" 
                        group="{{ $group }}" 
                        translation-key="{{ $key }}" 
                        route="{{ config('translation.ui_url') }}">
                    </translation-input>
                    </td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        <!--end::Body-->
    </div>
</form>
@endsection
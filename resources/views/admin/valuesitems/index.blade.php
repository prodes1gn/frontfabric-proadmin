@extends('admin.layouts.admin')
@section('styles')
@parent
@endsection
@section('content')
<!--begin::Advance Table Widget 3-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header">
        <h3 class="card-title align-items-start flex-column">
            <!--begin::Button-->
            @can('valuesitem_create')
            @if(config('cms.submenu_only_icons') == true)
            <a href="{{ route('admin.valuesitems.create') }}" class="btn btn-primary btn-icon font-weight-bold d-sm-none">
                <i class="fas fa-plus-circle"></i>
            </a>
            <a href="{{ route('admin.valuesitems.create') }}" class="btn btn-primary font-weight-bold d-none d-sm-block">
                <i class="fas fa-plus-circle"></i>
                {{ trans('global.add') }}
            </a>
            @else
            <a href="{{ route('admin.valuesitems.create') }}" class="btn btn-primary font-weight-bold">
                <i class="fas fa-plus-circle"></i>
                {{ trans('global.add') }}
            </a>
            @endif
            @endcan
            <!--end::Button-->
        </h3>
        <div class="card-toolbar">
            @include('admin.valuesitems.submenu')
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                @if(config('cms.submenu_only_icons') == true)
                <button type="button" class="btn btn-light-primary font-weight-bold dropdown-toggle d-sm-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-search"></i>
                </button>
                <button type="button" class="btn btn-light-primary font-weight-bold dropdown-toggle d-none d-sm-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-search"></i>
                    {{ trans('global.searching') }}
                </button>
                @else
                <button type="button" class="btn btn-light-primary font-weight-bold dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-search"></i>
                    {{ trans('global.searching') }}
                </button>
                @endif
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <form action="{{ route('admin.valuesitems.index') }}" method="GET">
                        <!--begin::Card-->
                        <div class="card card-filter">
                            <div class="card-body">
                                <div class="form-group">
                                    <input name="search" class="form-control form-control-solid" type="text" placeholder="{{ trans('global.search') }}" value="{{old('search', $request->search)}}">
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a type="submit" href="{{ route('admin.valuesitems.index') }}" class="btn btn-secondary font-weight-bold">
                                    <i class="fas fa-times"></i>
                                    {{ trans('global.clear') }}
                                </a>
                                <button type="submit" class="btn btn-primary font-weight-bold float-right">
                                    <i class="fa fa-search"></i>
                                    {{ trans('global.search') }}
                                </button>
                            </div>
                        </div>
                        <!--end::Card-->
                    </form>
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pb-5">
        <!--begin::Table-->
        <div class="table-responsive table-striped table-hover">
            <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                <thead>
                    <tr class="text-uppercase">
                        <th style="width:5%; min-width: 50px;" class="text-center">
                            <span class="text-dark-75">
                                #
                            </span>
                        </th>
                        <th style="width:20%; min-width: 200px;">
                            <span class="text-dark-75">
                                {{ trans('cruds.name') }}
                            </span>
                        </th>
                        <th colspan="2" style="width:20%; min-width: 150px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.order') }}
                            </span>
                        </th>
                        @can('valuesitem_edit')
                        <th style="width:10%; min-width: 200px;" class="text-center">
                            <span class="text-dark-75">
                                @if(CMS::isMulitLang())
                                {{ trans('global.translations') }}
                                @else
                                {{ trans('global.edit') }}
                                @endif
                            </span>
                        </th>
                        @endcan
                        <th style="width:5%; min-width: 150px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.delete') }}
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data)>0)
                    <?php $i = 0; ?>
                    @foreach($data as $key => $row)
                    <tr>
                        <td class="text-center font-weight-bold">
                            {{ ($data->currentpage()-1) * $data->perpage() + $key + 1 }}
                        </td>
                        <td>
                            @if(auth()->user()->can('valuesitem_show'))
                            <a href="{{ route('admin.valuesitems.show', $row->id) }}" class="font-weight-bold btn btn-light-primary btn-hover-primary btn-sm text-left">
                                <i class="text-primary far fa-eye"></i>
                                {{ $row->name ?? '' }}
                            </a>
                            @else
                            {{ $row->name ?? '' }}
                            @endif
                        </td>
                        @can('valuesitem_edit')
                        <td class="font-weight-bold text-right">
                            <form action="{{ route('admin.valuesitem.move', $row->id) }}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="order" value="{{ $row->order }}">
                                <input type="hidden" name="type" value="moveUp">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-icon btn-light-success btn-hover-success btn-xs" value="&#x25B4;">
                            </form>
                            <form action="{{ route('admin.valuesitem.move', $row->id) }}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="order" value="{{ $row->order }}">
                                <input type="hidden" name="type" value="moveDown">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-icon btn-light-danger btn-hover-danger btn-xs" value="&#x25BE;">
                            </form>
                        </td>
                        <td class="font-weight-bold text-left">
                            <span class="d-none d-lg-block">
                                <form action="{{ route('admin.valuesitem.move', $row->id) }}" method="POST" style="display: inline-block;">
                                    <input class="form-control form-control-order" type="number"  name="order" value="{{ $row->order }}">
                                    <input type="hidden" name="type" value="move">
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-icon btn-light-primary btn-hover-primary btn-xs" value="+">
                                </form>
                            </span>
                        </td>
                        @else
                        <td class="font-weight-bold text-center" colspan="2">
                            {{ $row->order }}
                        </td>
                        @endcan

                        @can('valuesitem_edit')
                        <td class="text-center">
                            @if(CMS::isMulitLang())
                            @foreach(config('translatable.locales') as $locale)
                            <a href="{{ route('admin.valuesitems.edit', $row->id) }}?lang={{ $locale }}" data-toggle="tooltip" data-theme="dark" title="{{ strtoupper($locale) }}" class="btn btn-icon btn-light btn-hover-secondary btn-sm">
                                <img src="{{ asset('uploads/settings/languages/' . mb_strtolower($locale, 'UTF-8') . '.png') }}" class="h-20px w-20px {{ (!$row->hasTranslation($locale)) ? 'opacity-20' : '' }}" alt="{{ strtoupper($locale) }}" />
                            </a>
                            @endforeach                     
                            @else
                            <a href="{{ route('admin.valuesitems.edit', $row->id) }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.edit') }}" class="btn btn-icon btn-light btn-hover-warning btn-sm">
                                <i class="text-warning far fa-edit"></i>
                            </a>
                            @endif
                        </td>
                        @endcan

                        <td class="text-center">  

                            @can('valuesitem_delete')
                            <!-- Button trigger modal-->
                            <button type="button" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="modal" data-target="#delete{{ $row->id }}">
                                <i class="text-danger far fa-trash-alt"></i>
                            </button>
                            <!-- Modal-->
                            <div class="modal fade" id="delete{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-left">
                                                {{ trans('global.confirm_delete_header') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            {!! trans('global.confirm_delete_question', ['resource' => $row->name]) !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary font-weight-bold float-right" data-dismiss="modal">{{ trans('global.close') }}</button>
                                            <form action="{{ route('admin.valuesitems.destroy', $row->id) }}" class="float-left" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="10">{{Lang::get('global.no_results')}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!--end::Table-->

    </div>
    <!--end::Body-->

    <!--begin::Pagination-->                           
    {{ $data->appends(request()->except(['page','_token']))->links('admin.partials._pagination') }}
    <!--end::Pagination-->

</div>
<!--end::Advance Table Widget 3-->

@endsection
@section('scripts')
@parent
@endsection
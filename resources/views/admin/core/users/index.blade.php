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
            @can('user_create')
            @if(config('cms.submenu_only_icons') == true)
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon font-weight-bold d-sm-none">
                <i class="fas fa-plus-circle"></i>
            </a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary font-weight-bold d-none d-sm-block">
                <i class="fas fa-plus-circle"></i>
                {{ trans('global.add') }}
            </a>
            @else
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary font-weight-bold">
                <i class="fas fa-plus-circle"></i>
                {{ trans('global.add') }}
            </a>
            @endif
            @endcan
            <!--end::Button-->
        </h3>
        <div class="card-toolbar">
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
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <!--begin::Card-->
                        <div class="card card-filter">
                            <div class="card-body">
                                <div class="form-group">
                                    <input name="search" class="form-control form-control-solid" type="text" placeholder="{{ trans('global.search') }}" value="{{ old('search', $request->search) }}">
                                </div>
                                <div class="form-group">
                                    <select class="form-control select2 select2_dropdown" name="status">
                                        <?php
                                        $statuses = ['all' => trans('global.all'), '0' => trans('global.deactive'), '1' => trans('global.active')];
                                        ?>
                                        @foreach ($statuses as $k => $v)
                                        <option value="{{ $k }}" {{ old('status', ($request->status == null) ? 'all' : $request->status ) == $k ? "selected" : ""}}>
                                            {{ $v }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a type="submit" href="{{ route("admin.users.index") }}" class="btn btn-secondary font-weight-bold">
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
                        <th style="width:15%; min-width: 200px;">
                            <span class="text-dark-75">
                                {{ trans('cruds.name') }}
                            </span>
                        </th>
                        <th style="width:15%; min-width: 200px;">
                            <span class="text-dark-75">
                                {{ trans('global.roles') }}
                            </span>
                        </th>
                        <th style="width:10%; min-width: 200px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.email_verified_at') }}
                            </span>
                        </th>
                        <th style="width:10%; min-width: 100px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.approved') }}
                            </span>
                        </th>
                        <th style="width:15%; min-width: 100px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.verified') }}
                            </span>
                        </th>
                        <th style="width:10%; min-width: 150px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.status') }}
                            </span>
                        </th>
                        <th colspan="2" style="width:10%; min-width: 200px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.order') }}
                            </span>
                        </th>
                        @can('user_edit')
                        <th style="width:5%; min-width: 150px;" class="text-center">
                            <span class="text-dark-75">
                                {{ trans('global.edit') }}
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
                            @if(auth()->user()->can('user_show'))
                            <a href="{{ route('admin.users.show', $row->id) }}" class="font-weight-bold btn btn-light-primary btn-hover-primary btn-sm text-left">
                                <i class="text-primary far fa-eye"></i>
                                {{ $row->name ?? '' }}
                            </a>
                            @else
                            {{ $row->name ?? '' }}
                            @endif
                        </td>
                        <td class="font-weight-bold opacity-80">
                            @foreach($row->roles as $key => $item)
                            <span class="label label-primary label-inline font-weight-bold mr-2">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            {{ $row->email_verified_at ?? '' }}
                        </td>
                        <td class="text-center opacity-80">
                            @if($row->approved)
                            <input data-switch="true" data-size="small"  type="checkbox" checked="checked" disabled="disabled" data-on-color="success" data-on-text="{{ trans('global.yes') }}" />
                            @else
                            <input data-switch="true" data-size="small" type="checkbox" disabled="disabled" data-off-color="danger" data-off-text="{{ trans('global.no') }}" />
                            @endif
                        </td>
                        <td class="text-center opacity-80">
                            @if($row->verified)
                            <input data-switch="true" data-size="small"  type="checkbox" checked="checked" disabled="disabled" data-on-color="success" data-on-text="{{ trans('global.yes') }}" />
                            @else
                            <input data-switch="true" data-size="small" type="checkbox" disabled="disabled" data-off-color="danger" data-off-text="{{ trans('global.no') }}" />
                            @endif
                        </td>
                        @can('user_edit')
                        <td class="text-center opacity-80">
                            <form action="{{ route('admin.users.status', $row->id) }}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="status" value="{{ ($row->status == 1) ? 0 : 1 }}">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-{{ ($row->status == 1) ? 'success' : 'danger' }} btn-xs">
                                    @if($row->status == 1)
                                    <i class="fas fa-check"></i>
                                    {{ trans('global.active') }}
                                    @else
                                    <i class="fas fa-times"></i>
                                    {{ trans('global.deactive') }}
                                    @endif
                                </button>
                            </form>
                        </td>
                        @endcan
                        <td class="font-weight-bold text-right">
                            @can('user_edit')
                            <form action="{{ route('admin.user.move', $row->id) }}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="order" value="{{ $row->order }}">
                                <input type="hidden" name="type" value="moveUp">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-icon btn-light-success btn-hover-success btn-xs" value="&#x25B4;">
                            </form>
                            <form action="{{ route('admin.user.move', $row->id) }}" method="POST" style="display: inline-block;">
                                <input type="hidden" name="order" value="{{ $row->order }}">
                                <input type="hidden" name="type" value="moveDown">
                                <input type="hidden" name="_method" value="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-icon btn-light-danger btn-hover-danger btn-xs" value="&#x25BE;">
                            </form>
                        </td>
                        <td class="font-weight-bold text-left">
                            <span class="d-none d-lg-block">
                                <form action="{{ route('admin.user.move', $row->id) }}" method="POST" style="display: inline-block;">
                                    <input class="form-control form-control-order" type="number"  name="order" value="{{ $row->order }}">
                                    <input type="hidden" name="type" value="move">
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-icon btn-light-primary btn-hover-primary btn-xs" value="+">
                                </form>
                            </span>
                            @endcan
                        </td>

                        @can('user_edit')
                        <td class="text-center">
                            <a href="{{ route('admin.users.edit', $row->id) }}" data-toggle="tooltip" data-theme="dark" title="{{ trans('global.edit') }}" class="btn btn-icon btn-light btn-hover-warning btn-sm">
                                <i class="text-warning far fa-edit"></i>
                            </a>
                        </td>
                        @endcan

                        <td class="pr-10 text-center">  

                            @can('user_delete')
                            <!-- Button trigger modal-->
                            <button type="button"  class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="modal" data-target="#delete{{ $row->id }}">
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
                                            <form action="{{ route('admin.users.destroy', $row->id) }}" class="float-left" method="POST">
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
                        <td colspan="11">{{Lang::get('global.no_results')}}</td>
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
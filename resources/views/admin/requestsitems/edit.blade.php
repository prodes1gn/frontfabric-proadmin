@extends('admin.layouts.admin')
@section('styles')
@parent
@endsection
@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">
                {{ trans('global.translation') }}:
                @if(CMS::isMulitLang())
                @foreach(config('translatable.locales') as $locale)
                <a href="{{ route('admin.requestsitems.edit', $requestsitem->id) }}?lang={{ $locale }}" data-toggle="tooltip" data-theme="dark" title="{{ strtoupper($locale) }}" class="btn btn-icon {{ $locale == $lang ? 'btn-light-secondary' : '' }} btn-hover-secondary">
                    <img src="{{ asset('uploads/settings/languages/' . mb_strtolower($locale, 'UTF-8') . '.png') }}" class="h-30px w-30px mb-1 {{ (!$requestsitem->hasTranslation($locale)) ? 'opacity-20' : '' }}" alt="{{ strtoupper($locale) }}" />
                </a>
                @endforeach  
                @endif
            </h3>
        </div>
        <div class="card-toolbar">
            @can('requestsitem_delete')
            @if($requestsitem->hasTranslation($lang) && $lang != config('translatable.locale'))
            <!-- Button trigger modal-->
            @if(config('cms.submenu_only_icons') == true)
            <button type="button" class="btn btn-light-danger font-weight-bold btn-hover-danger btn-sm btn-icon d-sm-none" data-toggle="modal" data-target="#delete{{ $requestsitem->id }}">
                <i class="text-danger far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-light-danger font-weight-bold btn-hover-danger btn-sm d-none d-sm-block" data-toggle="modal" data-target="#delete{{ $requestsitem->id }}">
                <i class="text-danger far fa-trash-alt"></i>
                {{ trans('global.delete') }}
            </button>
            @else
            <button type="button" class="btn btn-light-danger font-weight-bold btn-hover-danger btn-sm" data-toggle="modal" data-target="#delete{{ $requestsitem->id }}">
                <i class="text-danger far fa-trash-alt"></i>
                {{ trans('global.delete') }}
            </button>
            @endif
            <!-- Modal-->
            <div class="modal fade" id="delete{{ $requestsitem->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            {!! trans('global.confirm_delete_question', ['resource' => $requestsitem->name]) !!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary font-weight-bold float-right" data-dismiss="modal">{{ trans('global.close') }}</button>
                            <form action="{{ route('admin.requestsitem.delete', $requestsitem->id) }}" class="float-left" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="lang" value="{{ $lang }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endcan
        </div>
    </div>
    <!--end::Header-->
    <form method="POST" action="{{ route("admin.requestsitems.update", [$requestsitem->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="lang" value="{{ $lang }}">
        <!--begin::Body-->
        <div class="card-body pb-5 row">
            <div class="col-lg-8">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="required" for="name">{{ trans('cruds.name') }} <span class="required">*</span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="150" type="text" name="name" value="{{ old('name', $requestsitem->translateOrDefault($lang)->name) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.name') }}">
                    @if($errors->has('name'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('name') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div> 
                <!--CRUD-FIELD-TEXT-START-->
                <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                    <label for="text">{{ trans('cruds.text') }} <span class="required">*</span></label>
                    <textarea class="form-control form-control-solid tynimce" maxlength="100000" name="text" rows="3" placeholder="{{ trans('global.enter') }} {{ trans('cruds.text') }}">{{ old('text', $requestsitem->translateOrDefault($lang)->text) }}</textarea>
                    @if($errors->has('text'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('text') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
                <!--CRUD-FIELD-TEXT-END-->
                <!--CRUD-NEW-LANG-FIELD-->
            </div>
            <div class="col-lg-4" style="{{ ($lang != config('translatable.locale')) ? "visibility:hidden" : ""  }}">
                <!--CRUD-NEW-FIELD-->
            </div>
            <!--CRUD-PAGEBUILDER-MODULE-->
            <!--CRUD-SEO-MODULE-->
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
                <a type="submit" href="{{ route("admin.requestsitems.index") }}" class="btn btn-secondary font-weight-bold">
                    <i class="fas fa-angle-double-left"></i>
                    {{ trans('global.back') }}
                </a>
                <button type="submit" class="btn btn-primary font-weight-bold float-right">
                    <i class="far fa-save"></i>
                    {{ trans('global.save') }}
                </button>
                <button type="submit" name="action" value="1" class="btn btn-primary font-weight-bold float-right mr-5">
                    <i class="fas fa-check"></i>
                    {{ trans('global.edit') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<!--CRUD-NEW-FIELD-JS-->
@parent
@endsection
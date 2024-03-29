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
                <a href="{{ route('admin.servicespages.edit') }}?lang={{ $locale }}" data-toggle="tooltip" data-theme="dark" title="{{ strtoupper($locale) }}" class="btn btn-icon {{ $locale == $lang ? 'btn-light-secondary' : '' }} btn-hover-secondary">
                    <img src="{{ asset('uploads/settings/languages/' . mb_strtolower($locale, 'UTF-8') . '.png') }}" class="h-30px w-30px mb-1 {{ (!$servicespage->hasTranslation($locale)) ? 'opacity-20' : '' }}" alt="{{ strtoupper($locale) }}" />
                </a>
                @endforeach  
                @endif
            </h3>
        </div>
        <div class="card-toolbar">
            @can('servicespage_delete')
            @if($servicespage->hasTranslation($lang) && $lang != config('translatable.locale'))
            <!-- Button trigger modal-->
            @if(config('cms.submenu_only_icons') == true)
            <button type="button" class="btn btn-light-danger font-weight-bold btn-hover-danger btn-sm btn-icon d-sm-none" data-toggle="modal" data-target="#delete1">
                <i class="text-danger far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-light-danger font-weight-bold btn-hover-danger btn-sm d-none d-sm-block" data-toggle="modal" data-target="#delete1">
                <i class="text-danger far fa-trash-alt"></i>
                {{ trans('global.delete') }}
            </button>
            @else
            <button type="button" class="btn btn-light-danger font-weight-bold btn-hover-danger btn-sm" data-toggle="modal" data-target="#delete1">
                <i class="text-danger far fa-trash-alt"></i>
                {{ trans('global.delete') }}
            </button>
            @endif
            <!-- Modal-->
            <div class="modal fade" id="delete1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            {!! trans('global.confirm_delete_question', ['resource' => $servicespage->name]) !!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary font-weight-bold float-right" data-dismiss="modal">{{ trans('global.close') }}</button>
                            <form action="{{ route('admin.servicespage.delete', $servicespage->id) }}" class="float-left" method="POST">
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
    <form method="POST" action="{{ route("admin.servicespages.update", [$servicespage->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="lang" value="{{ $lang }}">
        <!--begin::Body-->
        <div class="card-body pb-5 row">
            <div class="col-lg-8">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="required" for="name">{{ trans('cruds.name') }} <span class="required">*</span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="50" type="text" name="name" value="{{ old('name', $servicespage->translateOrDefault($lang)->name) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.name') }}">
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
                    <label for="text">{{ trans('cruds.text') }} <span class="required"></span></label>
                    <textarea class="form-control form-control-solid tynimce" maxlength="100000" name="text" rows="3" placeholder="{{ trans('global.enter') }} {{ trans('cruds.text') }}">{{ old('text', $servicespage->translateOrDefault($lang)->text) }}</textarea>
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
            <div class="col-lg-12">
                <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionSEO">
                    <div class="card">
                        <div class="card-header" id="headingSEO">
                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSEO">
                                <span class="svg-icon svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                        </g>
                                    </svg>
                                </span>
                                <div class="card-label">{{ trans('global.seo_settings') }}</div>
                            </div>
                        </div>
                        <div id="collapseSEO" class="row collapse" data-parent="#accordionSEO">
                            <div class="card-body row">
                                <div class="col-lg-8">
                                    <!--CRUD-FIELD-SLUG-START-->
                <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                    <label for="slug">{{ trans('cruds.slug') }} <span class="required"></span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="255" type="text" name="slug" value="{{ old('slug', $servicespage->translateOrDefault($lang)->slug) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.slug') }}">
                    @if($errors->has('slug'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('slug') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
                <!--CRUD-FIELD-SLUG-END-->
                <!--CRUD-FIELD-SEOTITLE-START-->
                <div class="form-group {{ $errors->has('seotitle') ? 'has-error' : '' }}">
                    <label for="seotitle">{{ trans('cruds.seotitle') }} <span class="required"></span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="255" type="text" name="seotitle" value="{{ old('seotitle', $servicespage->translateOrDefault($lang)->seotitle) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.seotitle') }}">
                    @if($errors->has('seotitle'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('seotitle') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
                <!--CRUD-FIELD-SEOTITLE-END-->
                <!--CRUD-FIELD-SEODESCRIPTION-START-->
                <div class="form-group {{ $errors->has('seodescription') ? 'has-error' : '' }}">
                    <label for="seodescription">{{ trans('cruds.seodescription') }} <span class="required"></span></label>
                    <input class="form-control form-control-solid maxlength" maxlength="255" type="text" name="seodescription" value="{{ old('seodescription', $servicespage->translateOrDefault($lang)->seodescription) }}" placeholder="{{ trans('global.enter') }} {{ trans('cruds.seodescription') }}">
                    @if($errors->has('seodescription'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('seodescription') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
                <!--CRUD-FIELD-SEODESCRIPTION-END-->
                <!--CRUD-FIELD-SEOIMAGE-START-->
<div class="form-group {{ $errors->has('seoimage') ? 'has-error' : '' }}">
                    <label for="seoimage">{{ trans('cruds.seoimage') }} <span class="required"></span></label>
                    <div class="dropzone dropzone-default dropzone-primary dz-clickable" id="seoimage-dropzone">
                        <div class="dropzone-msg dz-message needsclick">
                            <h3 class="dropzone-msg-title">{{ trans('global.drop_files_here_to_upload') }}</h3>
                        </div>
                    </div>
                    @if($errors->has('seoimage'))
                    <span class="help-block" role="alert">{{ $errors->first('seoimage') }}</span>
                    @endif
                </div>
                <!--CRUD-FIELD-SEOIMAGE-END-->
                <!--CRUD-FIELD-SEOTYPE-START-->
                <div class="form-group {{ $errors->has('seotype') ? 'has-error' : '' }}">
                    <label for="seotype">{{ trans('cruds.seotype') }} <span class="required"></span></label>
                    <select class="form-control select2 select2_dropdown" name="seotype">
                        @foreach ($seotypes as $k => $v)
                        <option value="{{ $k }}" {{ old('seotype', $servicespage->translateOrDefault($lang)->seotype) == $k ? "selected" : "" }}>
                            {{ $v }}
                        </option>
                        @endforeach
                    </select>
                    @if($errors->has('seotype'))
                    <span class="help-block" role="alert">
                        @foreach($errors->get('seotype') as $message)
                        {{ $message }}<br />
                        @endforeach
                    </span>
                    @endif
                </div>
                <!--CRUD-FIELD-SEOTYPE-END-->
                <!--CRUD-NEW-SEO-LANG-FIELD-->
                                </div>
                                <div class="col-lg-4">
                                    <!--CRUD-NEW-SEO-FIELD-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Body-->
        <div class="card-footer d-flex justify-content-between">
            <div class="form-group-show">
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
<!--CRUD-FIELD-SEOIMAGE-JS-START-->
<script>
    var uploadedGalleryMap = {}
    Dropzone.options.seoimageDropzone = {
        url: '<?= route('admin.servicespage.storeMedia') ?>',
        maxFilesize: <?= Setting::get('gallery_max_filesize'); ?>, // MB
        acceptedFiles: '<?= Setting::get('gallery_upload_formats'); ?>',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: <?= Setting::get('gallery_max_filesize'); ?>,
            width: <?= Setting::get('gallery_max_width'); ?>,
            height: <?= Setting::get('gallery_max_height'); ?>
        },
        success: function (file, response) {
            $('form').find('input[name="seoimage"]').remove()
            $('form').append('<input type="hidden" name="seoimage" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="seoimage"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
<?php if (isset($servicespage) && $servicespage->seoimage) : ?>
                var file = <?= json_encode($servicespage->seoimage) ?>;
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="seoimage" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
<?php endif; ?>
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }

</script>
<!--CRUD-FIELD-SEOIMAGE-JS-END-->
<!--CRUD-NEW-FIELD-JS-->
@parent
@endsection
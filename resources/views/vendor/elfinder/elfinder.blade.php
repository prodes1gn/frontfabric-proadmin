@extends('admin.layouts.admin')
@section('styles')
<!-- jQuery and jQuery UI (REQUIRED) -->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<!-- elFinder CSS (REQUIRED) -->
<link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/elfinder.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset($dir.'/css/theme-gray.min.css') }}">
<style>
    #elfinder {
        font-weight: 400 !important;
        font-family: Montserrat, Helvetica, "sans-serif" !important;
        -ms-text-size-adjust: 100% !important;
        -webkit-font-smoothing: antialiased !important;
        -moz-osx-font-smoothing: grayscale !important;
    }
    .elfinder.ui-widget.ui-widget-content {
        box-shadow: none;
        border-right: 1px solid #f3f3f3;
    }
    .elfinder-toolbar {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
    .elfinder .elfinder-statusbar {
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }
    .card-header {
        border-bottom: 0;
    }
</style>
@parent
@endsection
@section('content')
@php
$title = trans('global.filemanager');
@endphp

<div id="elfinder"></div>

@endsection
@section('scripts')
<!-- jQuery and jQuery UI (REQUIRED) -->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<!-- elFinder JS (REQUIRED) -->
<script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script>
@if($locale)
<!-- elFinder translation (OPTIONAL) -->
<script src="{{ asset($dir."/js/i18n/elfinder.$locale.js") }}"></script>
@endif
<!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
// Documentation for client options:
// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
$().ready(function() {
$('#elfinder').elfinder({
// set your elFinder options here
@if ($locale)
        lang: '{{ $locale }}', // locale
        @endif
        resizable: false,
        uiOptions: {
        toolbar : [
                // toolbar configuration
                ['open'],
        ['back', 'forward'],
        ['reload'],
        ['home', 'up'],
        ['mkdir', 'mkfile', 'upload'],
        ['info'],
        ['copy', 'cut', 'paste'],
        ['rm'],
        ['duplicate', 'rename', 'edit'],
        ['extract', 'archive'],
        ['search'],
        ['view'],
        ]
        },
        contextmenu: {
        // navbarfolder menu
        navbar: ['open', 'download', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', '|', 'rename', '|', 'places', 'info', 'chmod', 'netunmount'],
                // current directory menu
                cwd: ['undo', 'redo', '|', 'back', 'up', 'reload', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', '|', 'view', 'sort', 'selectall', 'colwidth', '|', 'info', '|', 'fullscreen', '|'],
                // current directory file menu
                files: ['getfile', '|', 'open', 'download', 'opendir', '|', 'upload', 'mkdir', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'empty', '|', 'rename', 'edit', 'resize', '|', 'archive', 'extract', '|', 'selectall', 'selectinvert', '|', 'places', 'info', 'chmod', 'netunmount']
        },
        height: '75%',
        customData: {
        _token: '{{ csrf_token() }}'
        },
        url : '{{ route("elfinder.connector") }}', // connector URL
        soundPath: '{{ asset($dir.' / sounds') }}'
});
});
</script>
@parent
@endsection

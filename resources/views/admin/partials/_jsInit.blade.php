<script>
    (function() {
        window.KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };

        window.adminResourcesDictionary = {
            choose: '{{ trans('global.choose') }}',
            no_results: '{{ trans('global.no_results') }}',
            locale: '{{ app()->getLocale() }}',
            localeFull: '{{ app()->getLocale() }}_{{ strtoupper(app()->getLocale()) }}',
            text: '{{ trans('global.text') }}',
            title: '{{ trans('global.title') }}',
            pageLeaveConfirm: '{{ trans('global.page_leave_confirm') }}',
            tinyMceRoute: '{{ route('elfinder.tinymce5') }}',
            dropzone: {
                actions: '{{ trans('plugins.dropzone.actions') }}',
                dictDefaultMessage: '{{ trans('plugins.dropzone.dictDefaultMessage') }}',
                dictFallbackMessage: '{{ trans('plugins.dropzone.dictFallbackMessage') }}',
                dictFallbackText: '{{ trans('plugins.dropzone.dictFallbackText') }}',
                dictFileTooBig: '{{ trans('plugins.dropzone.dictFileTooBig') }}',
                dictInvalidFileType: '{{ trans('plugins.dropzone.dictInvalidFileType') }}',
                dictResponseError: '{{ trans('plugins.dropzone.dictResponseError') }}',
                dictCancelUpload: '{{ trans('plugins.dropzone.dictCancelUpload') }}',
                dictUploadCanceled: '{{ trans('plugins.dropzone.dictUploadCanceled') }}',
                dictCancelUploadConfirmation: '{{ trans('plugins.dropzone.dictCancelUploadConfirmation') }}',
                dictRemoveFile: '{{ trans('plugins.dropzone.dictRemoveFile') }}',
                dictMaxFilesExceeded: '{{ trans('plugins.dropzone.dictRemoveFileConfirmation') }}'
                // dictRemoveFileConfirmation: null,
                // dictFileSizeUnits: non-translatable
            },
            datepicker: {
                days: [
                    '{{ trans('plugins.datepicker.days.sunday') }}',
                    '{{ trans('plugins.datepicker.days.monday') }}',
                    '{{ trans('plugins.datepicker.days.tuesday') }}',
                    '{{ trans('plugins.datepicker.days.wednesday') }}',
                    '{{ trans('plugins.datepicker.days.thursday') }}',
                    '{{ trans('plugins.datepicker.days.friday') }}',
                    '{{ trans('plugins.datepicker.days.saturday') }}'
                ],
                daysShort: [
                    '{{ trans('plugins.datepicker.daysShort.sunday') }}',
                    '{{ trans('plugins.datepicker.daysShort.monday') }}',
                    '{{ trans('plugins.datepicker.daysShort.tuesday') }}',
                    '{{ trans('plugins.datepicker.daysShort.wednesday') }}',
                    '{{ trans('plugins.datepicker.daysShort.thursday') }}',
                    '{{ trans('plugins.datepicker.daysShort.friday') }}',
                    '{{ trans('plugins.datepicker.daysShort.saturday') }}'
                ],
                daysMin: [
                    '{{ trans('plugins.datepicker.daysMin.sunday') }}',
                    '{{ trans('plugins.datepicker.daysMin.monday') }}',
                    '{{ trans('plugins.datepicker.daysMin.tuesday') }}',
                    '{{ trans('plugins.datepicker.daysMin.wednesday') }}',
                    '{{ trans('plugins.datepicker.daysMin.thursday') }}',
                    '{{ trans('plugins.datepicker.daysMin.friday') }}',
                    '{{ trans('plugins.datepicker.daysMin.saturday') }}'
                ],
                months: [
                    '{{ trans('plugins.datepicker.months.january') }}',
                    '{{ trans('plugins.datepicker.months.february') }}',
                    '{{ trans('plugins.datepicker.months.march') }}',
                    '{{ trans('plugins.datepicker.months.april') }}',
                    '{{ trans('plugins.datepicker.months.may') }}',
                    '{{ trans('plugins.datepicker.months.june') }}',
                    '{{ trans('plugins.datepicker.months.july') }}',
                    '{{ trans('plugins.datepicker.months.august') }}',
                    '{{ trans('plugins.datepicker.months.september') }}',
                    '{{ trans('plugins.datepicker.months.october') }}',
                    '{{ trans('plugins.datepicker.months.november') }}',
                    '{{ trans('plugins.datepicker.months.december') }}'
                ],
                monthsShort: [
                    '{{ trans('plugins.datepicker.monthsShort.january') }}',
                    '{{ trans('plugins.datepicker.monthsShort.february') }}',
                    '{{ trans('plugins.datepicker.monthsShort.march') }}',
                    '{{ trans('plugins.datepicker.monthsShort.april') }}',
                    '{{ trans('plugins.datepicker.monthsShort.may') }}',
                    '{{ trans('plugins.datepicker.monthsShort.june') }}',
                    '{{ trans('plugins.datepicker.monthsShort.july') }}',
                    '{{ trans('plugins.datepicker.monthsShort.august') }}',
                    '{{ trans('plugins.datepicker.monthsShort.september') }}',
                    '{{ trans('plugins.datepicker.monthsShort.october') }}',
                    '{{ trans('plugins.datepicker.monthsShort.november') }}',
                    '{{ trans('plugins.datepicker.monthsShort.december') }}'
                ],
                today: '{{ trans('plugins.datepicker.today') }}',
                clear: '{{ trans('plugins.datepicker.clear') }}',
                titleFormat: '{{ trans('plugins.datepicker.titleFormat') }}',
                weekStart: {{ trans('plugins.datepicker.weekStart') }}
            }
        };
    })();
</script>

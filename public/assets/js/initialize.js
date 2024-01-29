;
(function ($, ard) {
    $(function () {
        var initLocalization = function () {
            $.fn.datepicker.dates['bg'] = ard.datepicker;
        };

        var initSelects = function () {
            $('.select2_dropdown').select2({
                placeholder: ard.choose,
                language: {
                    noResults: function (params) {
                        return ard.no_results;
                    }
                }
            });
            // multi select
            $('.select2_multiselect').select2({
                placeholder: ard.choose,
                language: {
                    noResults: function (params) {
                        return ard.no_results;
                    }
                }
            });
        };

        var initDatepicker = function () {
            var arrows = KTUtil.isRTL() ? {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            } : {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            };

            $('.datepicker').datepicker({
                rtl: KTUtil.isRTL(),
                todayBtn: 'linked',
                clearBtn: true,
                todayHighlight: true,
                templates: arrows,
                format: 'yyyy-mm-dd',
                language: ard.locale
            });
        };

        var initDatepicker1 = function () {
            $('.datetimepicker_1').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                language: ard.locale
            });
        };

        var initTagify = function () {
            var inputs = $('.tagify-input-control');

            inputs.each(function () {
                new Tagify(this, {
                    originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', ')
                });
            });
        };

        var initSearchMapInput = function () {
            if (!google || !google.maps || !google.maps.places || !google.maps.places.Autocomplete) {
                return;
            }

            var searchMapInputs = document.getElementsByClassName('searchMapInput');

            searchMapInputs.forEach((input) => {
                var autocomplete = new google.maps.places.Autocomplete(input);
                var inputParent = input.parentElement;

                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();

                    inputParent.querySelector('[data-name="searh-map-lat"]').value = place.geometry.location.lat();
                    inputParent.querySelector('[data-name="searh-map-lon"]').value = place.geometry.location.lng();
                });
            });
        };

        var initImageInput = function () {
            !!KTImageInput && new KTImageInput('kt_image_1');
        };

        var initLeavePrompt = function () {
            var langInput = $('input[name="lang"]');

            if (langInput.length === 0) {
                return;
            }

            var form = langInput.parents('form');

            if (!form) {
                return;
            }

            var beforeUnloadListener = function (e) {
                e.preventDefault();
                e.returnValue = ard.pageLeaveConfirm;

                return ard.pageLeaveConfirm;
            };

            $('input', form).one('change', function () {
                addEventListener('beforeunload', beforeUnloadListener, { capture: true });
            });

            form.on('submit', function () {
                removeEventListener('beforeunload', beforeUnloadListener, { capture: true });
            });
        };

        initLocalization();
        initSelects();
        initDatepicker();
        initDatepicker1();
        initTagify();
        initSearchMapInput();
        initImageInput();
        initLeavePrompt();
    });
})(jQuery, adminResourcesDictionary);

(function (ard) {
    var elFinderBrowser = function (callback, value, meta) {
        tinymce.activeEditor.windowManager.openUrl({
            title: 'File Manager',
            url: ard.tinyMceRoute,
            onMessage: function (dialogApi, details) {
                if (details.mceAction === 'fileSelected') {
                    const file = details.data.file;
                    // Make file info
                    const info = file.name;
                    // Provide file and text for the link dialog
                    if (meta.filetype === 'file') {
                        callback(file.url, {
                            text: info,
                            title: info
                        });
                    }

                    // Provide image and alt text for the image dialog
                    if (meta.filetype === 'image') {
                        callback(file.url, {
                            alt: info
                        });
                    }

                    // Provide alternative source and posted for the media dialog
                    if (meta.filetype === 'media') {
                        callback(file.url);
                    }

                    dialogApi.close();
                }
            }
        });
    };

    tinymce.init({
        selector: '.tynimce',
        language: ard.localeFull,
        height: 600,
        menubar: false,
        paste_enable_default_filters: false,
        plugins: 'code image link media hr advlist lists paste',
        toolbar1: 'paste formatselect | bold italic underline hr blockquote removeformat | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | link unlink | image media | code',
        block_formats: `${ard.text}=p;${ard.title} 2=h2;${ard.title} 3=h3;${ard.title} 4=h4;`,
        branding: false,
        file_picker_callback: elFinderBrowser,
        skin: 'oxide'
    });
})(adminResourcesDictionary);
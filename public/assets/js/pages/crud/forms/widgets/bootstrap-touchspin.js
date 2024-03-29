"use strict";
// Class definition
var KTKBootstrapTouchspin = function() {

    // Private functions
    var demos = function() {
        // minimum setup
        $('.touchspin_pagination').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            min: 5,
            max: 100,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10,
        });

        // with prefix
        $('.touchspin').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            min: 0,
            max: 100000,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10,
        });

        // vertical button alignment:
        $('.money').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            min: 0,
            max: 100000,
            step: 0.01,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
        });

        // vertical buttons with custom icons:
        $('#kt_touchspin_4, #kt_touchspin_2_4').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            verticalbuttons: true,
            verticalup: '<i class="ki ki-plus"></i>',
            verticaldown: '<i class="ki ki-minus"></i>'
        });

        // vertical buttons with custom icons:
        $('#kt_touchspin_5, #kt_touchspin_2_5').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            verticalbuttons: true,
            verticalup: '<i class="ki ki-arrow-up"></i>',
            verticaldown: '<i class="ki ki-arrow-down"></i>'
        });
    }

    var validationStateDemos = function() {
        // validation state demos
        $('#kt_touchspin_1_validate').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });

        // vertical buttons with custom icons:
        $('#kt_touchspin_2_validate').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
        });

        $('#kt_touchspin_3_validate').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',
            verticalbuttons: true,
            verticalupclass: 'ki ki-plus',
            verticaldownclass: 'ki ki-minus'
        });
    }

    return {
        // public functions
        init: function() {
            demos();
            validationStateDemos();
        }
    };
}();

jQuery(document).ready(function() {
    KTKBootstrapTouchspin.init();
});

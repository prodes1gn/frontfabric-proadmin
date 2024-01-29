// Class definition

var KTAutosize = function () {

    // Private functions
    var demos = function () {
        // basic demo
        var demo1 = $('.kt_autosize');

        autosize(demo1);
    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTAutosize.init();
});

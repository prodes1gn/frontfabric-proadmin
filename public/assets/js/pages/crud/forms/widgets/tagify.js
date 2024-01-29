; (function ($) {
    $(document).ready(function () {
        var inputs = $('.tagify-input-control');

        inputs.each(function () {
            new Tagify(this, {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(', ')
            });
        });
    });
})(jQuery);

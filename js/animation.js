(function($) {
    $('.cmb-type-animation select').change(function() {
        if( $(this).next('.cmb-animation-preview').length > 0 ) {
            $(this).next('.cmb-animation-preview').attr('class', 'cmb-animation-preview animated');
            $(this).next('.cmb-animation-preview').addClass($(this).val());
        }
    });
})(jQuery);
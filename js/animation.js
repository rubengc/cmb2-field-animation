(function($) {
    // Animate on change
    $('body').on('change.cmbAnimation', '.cmb-type-animation select', function (e) {
        if( $(this).next('.cmb-animation-preview').length > 0 ) {
            $(this).next('.cmb-animation-preview').attr('class', 'cmb-animation-preview button animated');
            $(this).next('.cmb-animation-preview').addClass($(this).val());
        }
    });

    // Animate on click
    $('body').on('click.cmbAnimationPreview', '.cmb-type-animation .cmb-animation-preview', function (e) {
        var $this = $(this);
        var animation = $this.attr('class').replace( 'cmb-animation-preview button', '' );
        var select_val = $this.prev('select').val();

        // If no animation, then return
        if( animation == '' && select_val == '' ) {
            return false;
        }

        // If select has animation
        if( animation == '' && select_val != '' ) {
            animation = $this.prev('select').val() + ' animated';
        }

        $this.attr('class', 'cmb-animation-preview button');

        setTimeout(function() {
            $this.addClass(animation);
        }, 100);
    });
})(jQuery);
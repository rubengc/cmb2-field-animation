(function($) {
    // Animate on change
    $('body').on('change.cmbAnimation', '.cmb-type-animation select', function (e) {
        var $this = $(this);
        var text = $this.next('.cmb-animation-preview-text');

        if( text.length > 0 ) {
            text.attr('class', 'cmb-animation-preview-text animated');
            text.addClass($(this).val());
        }
    });

    // Animate on click
    $('body').on('click.cmbAnimationPreview', '.cmb-type-animation .cmb-animation-preview-button', function (e) {
        var $this = $(this);
        var text = $this.next('.cmb-animation-preview-text');
        var animation = text.attr('class').replace( 'cmb-animation-preview-text', '' );
        var select_val = $this.prev('select').val();

        // If no animation, then return
        if( animation === '' && select_val === '' ) {
            return false;
        }

        // If select has animation
        if( select_val !== '' ) {
            animation = select_val + ' animated';
        }

        text.attr('class', 'cmb-animation-preview-text');

        setTimeout(function() {
            text.addClass(animation);
        }, 100);
    });
})(jQuery);
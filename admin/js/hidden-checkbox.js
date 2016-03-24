(function( $ ) {
	'use strict';

	/**
	 * Checks the hidden checkbox
	 */
	$( function() {
		$( ".btn-wrap" ).each( function() {

			var $this = $(this);
			var box = $this.children( 'input' );

			$this.on( 'click', function() {

				if ( box.is( ':checked' ) ) {

					box.attr( 'checked', false );

				} else {

					box.attr( 'checked', true );

				}
			});
		});
	});
})( jQuery );
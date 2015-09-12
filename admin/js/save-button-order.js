(function( $ ) {
	'use strict';

	/**
	 * Makes the buttons sortable using Jquery UI Sortable.
	 * Saves the data in the hidden button-order field and saves it via ajax.
	 */
	$(function() {

		$("#btns-sort").sortable({
			cursor: 'move',
			items: '.btn-wrap',
			opacity: 0.6,
			update: function() {

				var data = $(this).sortable('serialize') + '&action=save_button_order&sssNonce=' + Simple_Sharing_Ajax.sssNonce;

				$.post( ajaxurl, data, function( r ){

					if ( r <= 0 ) {

						$("#button-status").html( '<span class="status">' + Simple_Sharing_Ajax.error_message + '</span>' );
						$("#button-status").addClass( 'error' );
						$("#button-status").fadeIn( 'fast' );
						$("#button-status").fadeOut( 2000 );

					} else {

						$("#button-status").html( '<span class="status">' + r  + '</span>' );
						$("#button-status").addClass( 'updated' );
						$("#button-status").fadeIn( 'fast' );
						$("#button-status").fadeOut( 2000 );

					}

				});
			} // update
		});
	});

})( jQuery );

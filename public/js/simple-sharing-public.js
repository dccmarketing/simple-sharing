(function( $ ) {
	'use strict';

	/**
	 * Creates a pop-up with the URL in the link's href attribute
	 *
	 * @link 	https://jonsuh.com/blog/social-share-links/
	 *
	 * @param 	string 		url 			A URL
	 * @param 	float 		width			The width in pixels
	 * @param 	float 		height 			The height in pixels
	 *
	 * @return 	void 						Creates a pop-up window
	 */
	$(function() {

		function windowPopup(url, width, height) {

			// Calculate the position of the popup so
			// it’s centered on the screen.
			var left = (screen.width / 2) - (width / 2),
				top = (screen.height / 2) - (height / 2);

			window.open(
				url,
				'',
				'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left
			);
		}

		$('.ssbtn:not(.btn-email)').on('click', function(e) {
			e.preventDefault();

			windowPopup($(this).attr('href'), 500, 300);
		});

	});

})( jQuery );
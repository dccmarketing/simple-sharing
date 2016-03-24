<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Sharing_URL_Buttons
 * @subpackage 	Sharing_URL_Buttons/public/partials
 */

?><div class="simple-sharing-buttons">
	<span class="pre-btn-text"><?php

		echo apply_filters( 'simple-sharing-pre-button-text', esc_html__( 'Share This:', 'simple-sharing' ) );

	?></span><?php

	$modal_args['TB_iframe'] 	= 'true';
	$modal_args['height'] 		= '400';
	$modal_args['width'] 		= '550';

	apply_filters( $this->plugin_name . '- modal-args', $modal_args );

	$url 				= add_query_arg( $modal_args, '//twitter.com/intent/tweet' );

	// https://twitter.com/intent/tweet?text=Is+it+black+%26amp%3B+blue+or+white+%26amp%3B+gold.&height=400&TB_iframe=true&width=550#038;url=http%3A%2F%2Fdcc.dev%2Fdcc%2Fblack-blue-white-gold%2F

	?><a class="thickbox" href="<?php echo esc_url( $url ); ?>">CNN</a><?php

foreach ( $showthese as $button ) {

	?><a class="ssbtn btn-<?php echo esc_attr( $button['lower'] ) . ' ' . esc_attr( $class ); ?>" href="<?php echo esc_url( $button['url'] ); ?>" rel="nofollow">
		<span class="screen-reader-text"><?php

			echo $shared->get_reader_text( $button['name'] );

		?></span><?php

		echo $shared->get_label( $button['name'] );

	?></a><?php

} // foreach

?></div>
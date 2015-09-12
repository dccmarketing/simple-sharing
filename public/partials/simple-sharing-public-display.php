<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/public/partials
 */

?><div class="simple-sharing-buttons">
	<span class="pre-btn-text"><?php

		echo apply_filters( 'simple-sharing-pre-button-text', esc_html__( 'Share This:', 'simple-sharing' ) );

	?></span><?php

$shared 	= new Simple_Sharing_Shared( $this->plugin_name, $this->version );
$buttons 	= $shared->get_button_array();

if (  ) {

	$class = 'modal';

} else {

	$class = 'popup';

}

foreach ( $buttons as $button ) {

	$lower = strtolower( $button );

	if ( empty( $this->options['button-' . $lower] ) ) { continue; }

	?><a class="ssbtn btn-<?php echo $lower . ' ' . $class; ?>" href="<?php echo $this->get_url( $button ); ?>" rel="nofollow">
		<span class="screen-reader-text"><?php

			echo $shared->get_reader_text( $button );

		?></span><?php

		echo $shared->get_label( $button );

	?></a><?php

} // foreach

?></div>
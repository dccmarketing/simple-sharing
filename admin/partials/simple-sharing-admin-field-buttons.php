<?php

/**
 * Provides the markup for the Button Type field
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Simple_Sharing
 * @subpackage Simple_Sharing/admin/partials
 */

$shared 	= new Simple_Sharing_Shared( $this->plugin_name, $this->version );
$buttons 	= $shared->get_button_list();

?><fieldset>
	<legend><?php esc_html_e( 'Select any of the following buttons to display as sharing options:', 'simple-sharing' ); ?></legend>
	<ul id="btns-sort"><?php

	foreach ( $buttons as $button ) {

		$lower 	= strtolower( $button );
		$label 	= $shared->get_label( $button );
		$option = 0;

		if ( ! empty( $this->options['button-' . $lower] ) ) {

			$option = $this->options['button-' . $lower];

		}

		?><li class="btn-wrap">
			<input type="checkbox" name="<?php echo $this->plugin_name; ?>-options[button-<?php echo $lower; ?>]" id="<?php echo $this->plugin_name; ?>-options[button-<?php echo $lower; ?>]" value="1" <?php checked( 1, $option, true ); ?> />
			<label class="ssbtn btn-<?php echo $lower; ?>" for="<?php echo $lower; ?>">
				<span class="screen-reader-text"><?php

					echo $shared->get_reader_text( $button );

				?></span><?php

				echo $label;

			?></label>
		</li><?php

	} // foreach

	?></ul>
</fieldset>
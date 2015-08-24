<?php

/**
 * Provides the markup for the auto-pages checkbox
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Simple Sharing
 * @subpackage Simple Sharing/admin/partials
 */

$option = 0;

if ( ! empty( $this->options['auto-page'] ) ) {

	$option = $this->options['auto-page'];

}

?><input type="checkbox" id="<?php echo $this->plugin_name; ?>-options[auto-page]" name="<?php echo $this->plugin_name; ?>-options[auto-page]" value="1" <?php checked( 1, $option, true ); ?> />
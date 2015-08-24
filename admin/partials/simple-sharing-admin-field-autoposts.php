<?php

/**
 * Provides the markup for the auto-posts checkbox
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Simple Sharing
 * @subpackage Simple Sharing/admin/partials
 */

$option = 0;

if ( ! empty( $this->options['auto-post'] ) ) {

	$option = $this->options['auto-post'];

}

?><input type="checkbox" id="<?php echo $this->plugin_name; ?>-options[auto-post]" name="<?php echo $this->plugin_name; ?>-options[auto-post]" value="1" <?php checked( 1, $option, true ); ?> />
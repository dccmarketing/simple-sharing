<?php

/**
 * Provides the markup for the Delicious Account field
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Simple_Sharing
 * @subpackage Simple_Sharing/admin/partials
 */

$option = '';

if ( ! empty( $this->options['account-delicious'] ) ) {

	$option = $this->options['account-delicious'];

}

?><input class="text widefat" id="<?php echo $this->plugin_name; ?>-options[account-delicious]" name="<?php echo $this->plugin_name; ?>-options[account-delicious]" type="text" value="<?php echo esc_attr( $option ); ?>" />
<span class="description"><?php esc_html_e( 'Enter your Delicious username.', 'simple-sharing' ); ?></span>
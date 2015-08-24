<?php

/**
 * Provides the markup for the Tumblr Account field
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Simple_Sharing
 * @subpackage Simple_Sharing/admin/partials
 */

$option = '';

if ( ! empty( $this->options['account-tumblr'] ) ) {

	$option = $this->options['account-tumblr'];

}

?><input class="text widefat" id="<?php echo $this->plugin_name; ?>-options[account-tumblr]" name="<?php echo $this->plugin_name; ?>-options[account-tumblr]" type="text" value="<?php echo esc_attr( $option ); ?>" />
<span class="description"><?php esc_html_e( 'Enter your tumblr username.', 'simple-sharing' ); ?></span>
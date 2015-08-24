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

if ( ! empty( $this->options['account-twitter'] ) ) {

	$option = $this->options['account-twitter'];

}

?><input class="text widefat" id="<?php echo $this->plugin_name; ?>-options[account-twitter]" name="<?php echo $this->plugin_name; ?>-options[account-twitter]" type="text" value="<?php echo esc_attr( $option ); ?>" />
<span class="description"><?php esc_html_e( 'Enter your Twitter username.', 'simple-sharing' ); ?></span>
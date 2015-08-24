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

$option = '';

if ( ! empty( $this->options['button-type'] ) ) {

	$option = $this->options['button-type'];

}

$selections[] = 'Icon';
$selections[] = 'Text';

?><select aria-label="Select button type" class="field-button-type" id="<?php echo $this->plugin_name; ?>-options[button-type]" name="<?php echo $this->plugin_name; ?>-options[button-type]"><?php

foreach ( $selections as $selection ) {

	$lower = strtolower( $selection );

	?><option name="<?php esc_html_e( esc_attr( $selection ), 'simple-sharing' ); ?>" value="<?php echo esc_attr( $lower ); ?>" <?php selected( $option, $lower); ?>><?php esc_html_e( $selection, 'simple-sharing' ); ?></option><?php

} // foreach

?></select>
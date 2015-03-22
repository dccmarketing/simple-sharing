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

$return = '';

$return .= '<div class="simple-sharing-buttons">';
$return .= '<span class="pre-btn-text">' . apply_filters( 'simple-sharing-pre-button-text', __( 'Share This', 'dcc-marketing' ) . ': ' ) . '</span>';

// Move this to plugin options later
$networks = array( 'Email', 'Facebook', 'Google', 'LinkedIn', 'Pinterest', 'Reddit', 'tumblr', 'Twitter' );

foreach ( $networks as $network ) {

	$return .= '<a target="_blank" href="' . $this->get_url( $network ) . '" class="ssbtn btn-' . strtolower( $network ) . '" title="' . __( 'Share on', 'dcc-marketing' ) .  $network . '">' . $this->get_svg( $network ) . '</a>';

} // foreach

$return .= '</div>';
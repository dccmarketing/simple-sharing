<?php

/**
 * Provides an admin area view for the plugin
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Sharing_URL_Buttons
 * @subpackage Sharing_URL_Buttons/admin/partials
 */

?><h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<form method="post" action="options.php"><?php

settings_fields( $this->plugin_name . '-options' );

do_settings_sections( $this->plugin_name );

submit_button( 'Save Settings' );

?></form>
<h2><?php esc_html_e( 'Support', 'simple-sharing' ); ?></h2>
<div><?php

	printf( wp_kses( __( 'For usage instructions, FAQs, or technical information, check out the <a href="%1$s">documentation</a>.', 'simple-sharing' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'http://slushman.com/plugins/simple-sharing' ) );

?></div>
<div><?php

	printf( wp_kses( __( 'If you need help or have questions, please create a thread on the <a href="%1$s">WordPress.org forums</a>.', 'simple-sharing' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'https://wordpress.org/' ) );

?></div>
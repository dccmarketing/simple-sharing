<?php

/**
 * Provides the code for a settings page with no tabs
 *
 * @link 		http://dccmarketing.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/admin/partials
 */

?><h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
<form method="post" action="options.php"><?php

settings_fields( $this->plugin_name . '-options' );

do_settings_sections( $this->plugin_name );

submit_button( 'Save Settings' );

?></form>
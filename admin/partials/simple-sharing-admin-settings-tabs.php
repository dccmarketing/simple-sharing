<?php

/**
 * Provides the code for a settings page with tabs
 *
 * @link 		http://dccmarketing.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/admin/partials
 */

$tab 	= ( isset( $_GET['tab'] ) ? $_GET['tab'] : $this->get_default_tab(); );
$active = '';

?><h2 class="nav-tab-wrapper"><?php

foreach ( $this->tabs as $tab_slug => $tab_name ) {

	if ( $tab_slug == $tab ) { $active = 'nav-tab-active'; }

	?><a href="?page=<?php echo urlencode( $this->plugin_name ); ?>&tab=<?php echo urlencode( $tab_slug ); ?>" class="nav-tab <?php echo esc_attr( $active ); ?>"><?php echo esc_html( $tab_name ); ?></a><?php

} // foreach

?></h2>

<form method="post" action="options.php"><?php

	settings_fields( $tab );
	do_settings_sections( $tab );
	submit_button( 'Save Settings' );

?></form>
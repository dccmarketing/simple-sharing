<?php

/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @author 		Slushman <chris@slushman.com>
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/includes
 */
class Simple_Sharing_Activator {

	/**
	 * Creates the plugin settings and assigns default values.
	 *
	 * @since 		1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-simple-sharing-admin.php';

		$opts 		= array();
		$options 	= Simple_Sharing_Admin::get_options_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		}

		update_option( 'simple-sharing-options', $opts );

	} // activate()

}

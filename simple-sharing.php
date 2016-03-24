<?php

/**
 * @link				http://slushman.com
 * @since				1.0.0
 * @package				Sharing_URL_Buttons
 *
 * @wordpress-plugin
 * Plugin Name: 		Simple Sharing
 * Plugin URI:			http://slushman.com/simple-sharing/
 * Description:			Simple social network sharing buttons for sharing posts
 * Version:				1.0.0
 * Author:				Slushman
 * Author URI:			http://slushman.com/
 * License:				GPL-2.0+
 * License URI:			http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:			simple-sharing
 * Domain Path:			/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Used for referring to the plugin file or basename
if ( ! defined( 'SHARING_URL_BUTTONS_FILE' ) ) {
	define( 'SHARING_URL_BUTTONS_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sharing-url-buttons-activator.php
 */
function activate_Sharing_URL_Buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sharing-url-buttons-activator.php';
	Sharing_URL_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sharing-url-buttons-deactivator.php
 */
function deactivate_Sharing_URL_Buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sharing-url-buttons-deactivator.php';
	Sharing_URL_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Sharing_URL_Buttons' );
register_deactivation_hook( __FILE__, 'deactivate_Sharing_URL_Buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-sharing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 		1.0.0
 */
function run_Sharing_URL_Buttons() {

	$plugin = new Sharing_URL_Buttons();
	$plugin->run();

}
run_Sharing_URL_Buttons();

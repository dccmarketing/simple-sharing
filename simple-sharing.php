<?php

/**
 * @link				http://slushman.com
 * @since				1.0.0
 * @package				Simple_Sharing
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

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-sharing-activator.php
 */
function activate_Simple_Sharing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-sharing-activator.php';
	Simple_Sharing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-sharing-deactivator.php
 */
function deactivate_Simple_Sharing() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-sharing-deactivator.php';
	Simple_Sharing_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Simple_Sharing' );
register_deactivation_hook( __FILE__, 'deactivate_Simple_Sharing' );

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
function run_Simple_Sharing() {

	$plugin = new Simple_Sharing();
	$plugin->run();

}
run_Simple_Sharing();

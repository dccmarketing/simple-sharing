<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 		1.0.0
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Simple_Sharing {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Simple_Sharing_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$Simple_Sharing    The string used to uniquely identify this plugin.
	 */
	protected $Simple_Sharing;

	/**
	 * The current version of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$version 				The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$this->Simple_Sharing = 'simple-sharing';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Simple_Sharing_Loader. Orchestrates the hooks of the plugin.
	 * - Simple_Sharing_i18n. Defines internationalization functionality.
	 * - Simple_Sharing_Admin. Defines all hooks for the dashboard.
	 * - Simple_Sharing_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-sharing-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-simple-sharing-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-simple-sharing-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-sharing-public.php';

		$this->loader = new Simple_Sharing_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Simple_Sharing_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function set_locale() {

		$plugin_i18n = new Simple_Sharing_i18n();
		$plugin_i18n->set_domain( $this->get_Simple_Sharing() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Simple_Sharing_Admin( $this->get_Simple_Sharing(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', 	$plugin_admin, 	'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', 	$plugin_admin, 	'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_public_hooks() {

		$plugin_public = new Simple_Sharing_Public( $this->get_Simple_Sharing(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', 	$plugin_public, 	'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', 	$plugin_public, 	'enqueue_scripts' );
		$this->loader->add_action( 'init', 					$plugin_public, 	'register_shortcodes' );
		$this->loader->add_filter( 'the_content', 			$plugin_public, 	'add_sharing_buttons', 19 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 		1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_Simple_Sharing() {
		return $this->Simple_Sharing;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Simple_Sharing_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

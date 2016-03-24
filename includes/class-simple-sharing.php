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
 * @package		Sharing_URL_Buttons
 * @subpackage 	Sharing_URL_Buttons/includes
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
 * @package		Sharing_URL_Buttons
 * @subpackage 	Sharing_URL_Buttons/includes
 * @author 		Slushman <chris@slushman.com>
 */
class Sharing_URL_Buttons {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Sharing_URL_Buttons_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * Sanitizer for cleaning user input
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		Sharing_URL_Buttons_Sanitize    $sanitizer    Sanitizes data
	 */
	private $sanitizer;

	/**
	 * Shared methods
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		Sharing_URL_Buttons_Shared    $shared    Methods shared by the admin and public
	 */
	protected $shared;

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

		$this->plugin_name = 'simple-sharing';
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
	 * - Sharing_URL_Buttons_Loader. Orchestrates the hooks of the plugin.
	 * - Sharing_URL_Buttons_i18n. Defines internationalization functionality.
	 * - Sharing_URL_Buttons_Admin. Defines all hooks for the dashboard.
	 * - Sharing_URL_Buttons_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sharing-url-buttons-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sharing-url-buttons-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-sharing-url-buttons-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-sharing-url-buttons-public.php';

		/**
		 * The class responsible for sanitizing user input
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sharing-url-buttons-sanitize.php';

		/**
		 * The class with methods shared by admin and public
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sharing-url-buttons-shared.php';

		$this->loader = new Sharing_URL_Buttons_Loader();
		$this->sanitizer = new Sharing_URL_Buttons_Sanitize();
		$this->shared = new Sharing_URL_Buttons_Shared( $this->plugin_name, $this->version );

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Sharing_URL_Buttons_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function set_locale() {

		$plugin_i18n = new Sharing_URL_Buttons_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );
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

		$plugin_admin = new Sharing_URL_Buttons_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $this, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'plugin_action_links_' . SHARING_URL_BUTTONS_FILE, $plugin_admin, 'link_settings' );
		$this->loader->add_action( 'plugin_row_meta', $plugin_admin, 'link_row', 10, 2 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_sections' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_fields' );
		$this->loader->add_action( 'wp_ajax_save_button_order', $plugin_admin, 'save_button_order' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_public_hooks() {

		$plugin_public = new Sharing_URL_Buttons_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $this, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );
		$this->loader->add_action( 'init', $plugin_public, 'add_thickbox' );
		$this->loader->add_filter( 'the_content', $plugin_public, 'add_sharing_buttons', 19 );

		/**
		 * Action instead of template tag.
		 *
		 * do_action( 'simplesharing' );
		 *
		 * @link 	http://nacin.com/2010/05/18/rethinking-template-tags-in-plugins/
		 */
		$this->loader->add_action( 'simplesharing', $plugin_public, 'shortcode' );

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-sharing-shared.css', array(), $this->version, 'all' );

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
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Sharing_URL_Buttons_Loader    Orchestrates the hooks of the plugin.
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

} // class

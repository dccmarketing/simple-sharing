<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/admin
 * @author 		Slushman <chris@slushman.com>
 */
class Simple_Sharing_Admin {

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 		The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @var 		string 			$plugin_name 		The name of this plugin.
	 * @var 		string 			$version 				The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_options();

	}

	/**
	 * Adds a settings page link to a menu
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function add_menu() {

		add_submenu_page(
			'options-general.php',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Simple Sharing Settings', 'simple-sharing' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Simple Sharing', 'simple-sharing' ) ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options' )
		);

	} // add_menu()

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		/*$screen = get_current_screen();

		if ( $screen->id == $hook_suffix ) {*/

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-sharing-admin.min.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), $this->version, true );

		//}

	}

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_account_delicious() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-account-delicious.php' );

	} // field_account_delicious()

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_account_twitter() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-account-twitter.php' );

	} // field_account_twitter()

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_account_tumblr() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-account-tumblr.php' );

	} // field_account_tumblr()

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_auto_pages() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-autopages.php' );

	} // field_auto_pages()

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_auto_posts() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-autoposts.php' );

	} // field_auto_posts()

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_buttons() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-buttons.php' );

	} // field_buttons()

	/**
	 * Creates a settings field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function field_button_type() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-field-button-type.php' );

	} // field_button_type()

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
	 * Returns an array of options names, fields types, and default values
	 *
	 * @return 		array 			An array of options
	 */
	public static function get_options_list() {

		$options = array();

		$options[] 	= array( 'auto-post', 'checkbox', 0 );
		$options[] 	= array( 'auto-page', 'checkbox', 0 );
		$options[] 	= array( 'account-delicious', 'text', '' );
		$options[] 	= array( 'account-tumblr', 'text', '' );
		$options[] 	= array( 'account-twitter', 'text', '' );
		$options[] 	= array( 'button-buffer', 'checkbox', 0 );
		$options[] 	= array( 'button-delicious', 'checkbox', 0 );
		$options[] 	= array( 'button-digg', 'checkbox', 0 );
		$options[] 	= array( 'button-email', 'checkbox', 0 );
		$options[] 	= array( 'button-facebook', 'checkbox', 0 );
		$options[] 	= array( 'button-google', 'checkbox', 0 );
		$options[] 	= array( 'button-linkedin', 'checkbox', 0 );
		$options[] 	= array( 'button-pinterest', 'checkbox', 0 );
		$options[] 	= array( 'button-reddit', 'checkbox', 0 );
		$options[] 	= array( 'button-stumbleupon', 'checkbox', 0 );
		$options[] 	= array( 'button-tumblr', 'checkbox', 0 );
		$options[] 	= array( 'button-twitter', 'checkbox', 0 );
		$options[] 	= array( 'button-vk', 'checkbox', 0 );
		$options[] 	= array( 'button-xing', 'checkbox', 0 );
		$options[] 	= array( 'button-type', 'select', 'icon' );

		return $options;

	} // get_options_list()

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;

	}

	/**
	 * Adds links to the plugin links row
	 *
	 * @since 		1.0.0
	 * @param 		array 		$links 		The current array of row links
	 * @param 		string 		$file 		The name of the file
	 * @return 		array 					The modified array of row links
	 */
	public function link_row( $links, $file ) {

		if ( SIMPLE_SHARING_FILE === $file ) {

			$links[] = '<a href="http://twitter.com/slushman">Twitter</a>';

		}

		return $links;

	} // link_row()

	/**
	 * Adds a link to the plugin settings page
	 *
	 * @since 		1.0.0
	 * @param 		array 		$links 		The current array of links
	 * @return 		array 					The modified array of links
	 */
	public function link_settings( $links ) {

		$links[] = sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'options-general.php?page=' . $this->plugin_name . '-settings' ) ), esc_html__( 'Settings', 'simple-sharing' ) );

		return $links;

	} // link_settings()

	/**
	 * Creates the options page
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function page_options() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-page-settings.php' );

	} // page_options()

	/**
	 * Registers plugin settings, sections, and fields
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback );

		register_setting(
			$this->plugin_name . '-options',
			$this->plugin_name . '-options',
			array( $this, 'validate_options' )
		);

	} // register_settings()

	public function register_sections() {

		// add_settings_section( $id, $title, $callback, $menu_slug );

		add_settings_section(
			$this->plugin_name . '-buttons',
			apply_filters( $this->plugin_name . '-section-title-buttons', esc_html__( 'Buttons', 'simple-sharing' ) ),
			array( $this, 'section_buttons' ),
			$this->plugin_name
		);

		add_settings_section(
			$this->plugin_name . '-auto-display',
			apply_filters( $this->plugin_name . '-section-title-autodisplay', esc_html__( 'Automatically Show Buttons', 'simple-sharing' ) ),
			array( $this, 'section_auto_display' ),
			$this->plugin_name
		);

		add_settings_section(
			$this->plugin_name . '-accounts',
			apply_filters( $this->plugin_name . '-section-title-accounts', esc_html__( 'Your Social Accounts', 'simple-sharing' ) ),
			array( $this, 'section_accounts' ),
			$this->plugin_name
		);

	} // register_sections()

	public function register_fields() {

		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

		add_settings_field(
			'auto-post',
			apply_filters( $this->plugin_name . '-label-auto-posts', esc_html__( 'After posts', 'simple-sharing' ) ),
			array( $this, 'field_auto_posts' ),
			$this->plugin_name,
			$this->plugin_name . '-auto-display'
		);

		add_settings_field(
			'auto-page',
			apply_filters( $this->plugin_name . '-label-auto-pages', esc_html__( 'After pages', 'simple-sharing' ) ),
			array( $this, 'field_auto_pages' ),
			$this->plugin_name,
			$this->plugin_name . '-auto-display'
		);

		add_settings_field(
			'account-delicious',
			apply_filters( $this->plugin_name . '-label-account-delicious', esc_html__( 'Delicious Account', 'simple-sharing' ) ),
			array( $this, 'field_account_delicious' ),
			$this->plugin_name,
			$this->plugin_name . '-accounts'
		);

		add_settings_field(
			'account-twitter',
			apply_filters( $this->plugin_name . '-label-account-twitter', esc_html__( 'Twitter Account', 'simple-sharing' ) ),
			array( $this, 'field_account_twitter' ),
			$this->plugin_name,
			$this->plugin_name . '-accounts'
		);

		add_settings_field(
			'account-tumblr',
			apply_filters( $this->plugin_name . '-label-account-tumblr', esc_html__( 'Tumblr Account', 'simple-sharing' ) ),
			array( $this, 'field_account_tumblr' ),
			$this->plugin_name,
			$this->plugin_name . '-accounts'
		);

		add_settings_field(
			'buttons',
			apply_filters( $this->plugin_name . '-label-buttons', esc_html__( 'Buttons', 'simple-sharing' ) ),
			array( $this, 'field_buttons' ),
			$this->plugin_name,
			$this->plugin_name . '-buttons'
		);

		add_settings_field(
			'button-type',
			apply_filters( $this->plugin_name . '-label-button-type', esc_html__( 'Button Type', 'simple-sharing' ) ),
			array( $this, 'field_button_type' ),
			$this->plugin_name,
			$this->plugin_name . '-buttons'
		);

	} // register_fields()

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function section_accounts( $params ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-section-accounts.php' );

	} // section_accounts()

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function section_auto_display( $params ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-section-autodisplay.php' );

	} // section_auto_display()

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function section_buttons( $params ) {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-admin-section-buttons.php' );

	} // section_buttons()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Validates saved options
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 			array of submitted plugin options
	 * @return 		array 						array of validated plugin options
	 */
	public function validate_options( $input ) {

		$valid 		= array();
		$options 	= $this->get_options_list();

		foreach ( $options as $option ) {

			if ( ! isset( $input[$option[0]] ) ) { continue; }

			$sanitizer = new Simple_Sharing_Sanitize();

			$sanitizer->set_data( $input[$option[0]] );
			$sanitizer->set_type( $option[1] );

			$valid[$option[0]] = $sanitizer->clean();

			if ( $valid[$option[0]] != $input[$option[0]] ) {

				add_settings_error( $option[0], $option[0] . '_error', esc_html__( $option[0] . ' error.', 'simple-sharing' ), 'error' );

			}

			unset( $sanitizer );

		}

		return $valid;

	} // validate_options()

} // class

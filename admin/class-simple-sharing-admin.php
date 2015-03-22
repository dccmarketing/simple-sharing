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
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$Simple_Sharing 		The ID of this plugin.
	 */
	private $Simple_Sharing;

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
	 * @var 		string 			$Simple_Sharing 		The name of this plugin.
	 * @var 		string 			$version 				The version of this plugin.
	 */
	public function __construct( $Simple_Sharing, $version ) {

		$this->Simple_Sharing = $Simple_Sharing;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->Simple_Sharing, plugin_dir_url( __FILE__ ) . 'css/simple-sharing-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->Simple_Sharing, plugin_dir_url( __FILE__ ) . 'js/simple-sharing-admin.js', array( 'jquery' ), $this->version, false );

	}

}

<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/public
 * @author 		Slushman <chris@slushman.com>
 */
class Simple_Sharing_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$Simple_Sharing    The ID of this plugin.
	 */
	private $Simple_Sharing;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 				The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @var 		string 			$Simple_Sharing 		The name of the plugin.
	 * @var 		string 			$version 				The version of this plugin.
	 */
	public function __construct( $Simple_Sharing, $version ) {

		$this->Simple_Sharing = $Simple_Sharing;
		$this->version = $version;

	}

	/**
	 * Adds sharing buttons to the bottom of posts
	 *
	 * @todo  	Make this selectable in plugin options
	 *
	 * @param 	mixed 		$content 		The current content
	 * @return 	mixed 						The altered content
	 */
	public function add_sharing_buttons( $text ) {

		global $post, $wp_current_filter;

		// Return under these conditions
		if ( empty( $post ) ) { 	return $text; } // empty post
		if ( is_preview() ) { 		return $text; } // is preview
		if ( is_page() ) { 			return $text; } // is page
		if ( is_home() ) { 			return $text; } // is home page
		if ( is_front_page() ) { 	return $text; } // is front page
		if ( is_feed() ) { 			return $text; } // is RSS feed
		if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) { return $text; } // is excerpt

		$done = false;
		foreach ( $wp_current_filter as $filter ) {

			if ( 'the_content' == $filter ) {
				if ( $done ) {
					return $text;
				} else {
					$done = true;
				}
			}

		} // foreach

		if ( is_singular() && is_main_query() ) {

			$text = $text . $this->simple_sharing_buttons();

		}

		return $text;

	} // add_sharing_buttons()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->Simple_Sharing, plugin_dir_url( __FILE__ ) . 'css/simple-sharing-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->Simple_Sharing, plugin_dir_url( __FILE__ ) . 'js/simple-sharing-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers all shortcodes at once
	 *
	 * @return [type] [description]
	 */
	public function register_shortcodes() {

		add_shortcode( 'simplesharingbuttons', array( $this, 'shortcode' ) );

	} // register_shortcodes()

	/**
	 * Processes shortcode
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 *
	 * @uses	get_option
	 * @uses	get_layout
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function shortcode( $atts ) {

		ob_start();

		echo $this->simple_sharing_buttons();

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

	/**
	 * Displays the sharing buttons
	 *
	 * @since 		1.0.0
	 * @return 		mixed 		The sharing buttons HTML
	 */
	public function simple_sharing_buttons() {

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-public-display.php' );

		return $return;

	} // simple_sharing_buttons()

	private function get_svg( $network ) {

		$return = '';

		switch ( $network ) {

			case 'Email': 		$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="email" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M506 411.2c0 24.6-20.1 44.6-44.6 44.6H50.6C26.1 455.9 6 435.8 6 411.2V107.6C6 83.1 26.1 63 50.6 63h410.7c24.6 0 44.6 20.1 44.6 44.6V411.2zM461.4 98.7H50.6c-4.7 0-8.9 4.2-8.9 8.9 0 31.8 15.9 59.4 41 79.2 37.4 29.3 74.8 58.9 111.9 88.5 14.8 12 41.6 37.7 61.1 37.7h0.3 0.3c19.5 0 46.3-25.7 61.1-37.7 37.1-29.6 74.5-59.2 111.9-88.5 18.1-14.2 41-45.2 41-68.9C470.3 111 472 98.7 461.4 98.7zM470.3 196.9c-5.9 6.7-12.3 12.8-19.3 18.4 -39.9 30.7-80.1 61.9-118.9 94.3 -20.9 17.6-46.9 39.1-75.9 39.1H256h-0.3c-29 0-55-21.5-75.9-39.1 -38.8-32.4-79-63.6-118.9-94.3 -7-5.6-13.4-11.7-19.3-18.4v214.3c0 4.7 4.2 8.9 8.9 8.9h410.7c4.7 0 8.9-4.2 8.9-8.9V196.9z"/></svg>'; break;
			case 'Facebook': 	$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="facebook" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M82.2 21.1H72.1c-7.9 0-9.4 3.8-9.4 9.2v12.1h18.8l-2.5 19H62.8v48.7H43.1V61.5H26.8v-19h16.4v-14c0-16.2 9.9-25.1 24.5-25.1 6.9 0 12.9 0.5 14.6 0.8V21.1z"/></svg>'; break;
			case 'Google': 		$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="googleplus" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M310 366.3c0 15.3-4.5 30.4-12.1 43.4 -25.9 43.9-79.9 59.5-127.8 59.5 -37.7 0-84.1-9.8-105-44.9 -6-9.8-9.3-21.3-9.3-32.9 0-28.4 17.6-52 40.9-66.5 29.4-18.3 67.5-22.9 101.5-25.1 -8.8-11.6-15.8-21.8-15.8-36.9 0-8 2.3-14.3 5.3-21.3 -5.8 0.5-11.3 1-17.1 1 -49 0-88.1-35.7-88.1-85.6 0-27.6 13.1-54.7 33.9-72.8 27.1-23.4 65.5-32.6 100.4-32.6h105l-34.7 22.1h-32.9c23.4 19.8 37.7 41.9 37.7 73.6 0 65-59.5 72.3-59.5 104.2C232.4 284.5 310 295.5 310 366.3zM274.4 387.7c0-33.9-33.6-54.5-58-72.1 -4-0.5-8-0.5-12.1-0.5 -40.9 0-101.7 13.1-101.7 64.8 0 49 53 66.5 93.7 66.5C233.4 446.4 274.4 430.9 274.4 387.7zM231.9 212.1c10.3-11 13.3-25.1 13.3-39.9 0-37.2-21.8-100.2-67-100.2 -14.1 0-28.6 7-37.2 18.1 -9 11.3-11.8 26.1-11.8 40.2 0 37.7 21.3 96.9 66.5 96.9C208.3 227.2 223.1 221.2 231.9 212.1zM453.2 226.5v27.1h-53.5v55h-26.4v-55h-53.2v-27.1h53.2V172h26.4v54.5H453.2z"/></svg>'; break;
			case 'LinkedIn': 	$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="linkedin" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M14.2 25.9H14c-6.8 0-11.2-4.7-11.2-10.5 0-6 4.5-10.5 11.4-10.5 6.9 0 11.2 4.5 11.3 10.5C25.6 21.2 21.2 25.9 14.2 25.9zM24.3 95H4V34.2h20.3V95zM97.1 95H77V62.5c0-8.2-2.9-13.8-10.3-13.8 -5.6 0-8.9 3.7-10.4 7.4 -0.5 1.4-0.7 3.1-0.7 5V95H35.5c0.2-55.1 0-60.8 0-60.8h20.2V43h-0.1c2.6-4.2 7.4-10.3 18.4-10.3 13.3 0 23.3 8.7 23.3 27.4V95z"/></svg>'; break;
			case 'Pinterest': 	$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="pinterest" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M50 97c-4.7 0-9.1-0.7-13.4-2 1.8-2.8 3.8-6.4 4.8-10.1 0 0 0.6-2.1 3.3-13 1.6 3.1 6.4 5.9 11.5 5.9 15.2 0 25.5-13.8 25.5-32.4 0-13.9-11.8-27-29.9-27 -22.3 0-33.6 16.1-33.6 29.5 0 8.1 3.1 15.3 9.6 18 1 0.4 2 0 2.3-1.2 0.2-0.8 0.7-2.9 1-3.7 0.3-1.2 0.2-1.6-0.7-2.6 -1.9-2.3-3.1-5.2-3.1-9.3 0-11.9 8.9-22.6 23.2-22.6 12.6 0 19.6 7.7 19.6 18.1 0 13.6-6 25-15 25 -4.9 0-8.6-4.1-7.4-9.1 1.4-6 4.2-12.4 4.2-16.7 0-3.9-2.1-7.1-6.4-7.1 -5 0-9.1 5.2-9.1 12.2 0 0 0 4.5 1.5 7.5 -5.2 21.9-6.1 25.7-6.1 25.7C31 85.7 31 89.7 31.1 93 14.5 85.7 2.9 69.2 2.9 49.8 2.9 23.8 24 2.7 50 2.7c26 0 47.1 21.1 47.1 47.1S76 97 50 97z"/></svg>'; break;
			case 'Reddit': 		$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="reddit" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M476.5 297.6c0.8 5 1.3 10.3 1.3 15.3 0 40.7-23.9 78.3-66.8 106.5 -41.9 27.4-97.2 42.4-155.9 42.4 -58.8 0-114.3-15.1-155.9-42.4C55.9 391.3 32.3 353.6 32.3 313c0-5.5 0.5-11 1.3-16.6 -15.8-10-26.6-27.9-26.6-48 0-31.4 25.4-56.8 56.8-56.8 14.1 0 27.1 5.3 37.2 13.8 40.2-25.6 92.7-40.2 148.7-41.2l33.6-106.2c1.5-4.8 6.5-7.5 11.6-6.5l87.1 20.6c7.3-16.6 23.9-28.1 42.9-28.1 25.9 0 46.7 21.1 46.7 46.7 0 25.9-20.8 47-46.7 47 -25.6 0-46.5-20.8-46.7-46.5l-79.1-18.6 -29.1 91.9c53 2.3 102.5 16.8 140.6 41.7 10-9 23.4-14.6 37.9-14.6 31.4 0 56.8 25.4 56.8 56.8C505.1 269.5 493.6 287.9 476.5 297.6zM39 276.3c8-21.6 23.4-41.7 45.2-59 -5.8-4-13.1-6.3-20.6-6.3 -20.6 0-37.4 16.8-37.4 37.4C26.2 259.5 31.3 269.5 39 276.3zM458.4 313c0-33.6-20.6-65.8-58-90.1 -38.7-25.1-90.4-39.2-145.4-39.2 -55 0-106.7 14.1-145.4 39.2 -37.4 24.4-58 56.5-58 90.1 0 33.9 20.6 66 58 90.4 38.7 25.1 90.4 39.2 145.4 39.2 55 0 106.7-14.1 145.4-39.2C437.8 379 458.4 346.9 458.4 313zM181.2 320.2c-18.8 0-34.9-15.3-34.9-34.2 0-19.1 16.1-34.9 34.9-34.9 18.8 0 34.4 15.8 34.4 34.9C215.6 304.9 200 320.2 181.2 320.2zM336.4 370.2c3.8 3.8 3.8 10 0 13.8 -16.8 16.8-42.9 24.9-80.1 24.9h-0.5c-37.2 0-63.3-8-80.1-24.9 -3.8-3.8-3.8-10 0-13.8 3.8-3.8 9.8-3.8 13.6 0 13.1 13.1 34.7 19.3 66.5 19.3h0.5c31.6 0 53.5-6.3 66.5-19.3C326.6 366.5 332.6 366.5 336.4 370.2zM365.7 286.1c0 18.8-15.6 34.2-34.4 34.2 -18.8 0-34.9-15.3-34.9-34.2 0-19.1 16.1-34.9 34.9-34.9C350.2 251.2 365.7 267 365.7 286.1zM397.4 90.7c0 15.1 12.3 27.4 27.4 27.4s27.4-12.3 27.4-27.4 -12.3-27.4-27.4-27.4S397.4 75.7 397.4 90.7zM485.8 248.4c0-20.6-16.8-37.4-37.4-37.4 -8 0-15.6 2.5-21.6 7 21.6 17.3 36.9 37.7 44.7 59.8C480.2 270.8 485.8 260.2 485.8 248.4z"/></svg>'; break;
			case 'tumblr': 		$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="tumblr" viewBox="0 0 512 512" enable-background="new 0 0 512 512"><path d="M398.9 462.5c-8.4 12.6-46.3 26.8-80.4 27.3C217.2 491.5 179 417.9 179 366V214.2h-46.9v-60c70.3-25.4 87.3-89 91.2-125.3 0.3-2.2 2.2-3.3 3.3-3.3 0 0 1.1 0 68.1 0v118.3h92.9v70.3h-93.2v144.5c0 19.5 7.3 46.6 44.6 45.8 12.3-0.3 28.7-3.9 37.4-8.1L398.9 462.5z"/></svg>'; break;
			case 'Twitter': 	$return = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="twitter" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M101.2 33.6c0.1 1 0.1 2 0.1 3 0 30.5-23.2 65.6-65.6 65.6 -13.1 0-25.2-3.8-35.4-10.4 1.9 0.2 3.6 0.3 5.6 0.3 10.8 0 20.7-3.6 28.6-9.9 -10.1-0.2-18.6-6.9-21.6-16 1.4 0.2 2.9 0.4 4.4 0.4 2.1 0 4.1-0.3 6.1-0.8C12.7 63.7 4.8 54.4 4.8 43.2c0-0.1 0-0.2 0-0.3 3.1 1.7 6.6 2.8 10.4 2.9C9 41.7 4.9 34.6 4.9 26.6c0-4.3 1.1-8.2 3.1-11.6 11.4 14 28.4 23.1 47.6 24.1 -0.4-1.7-0.6-3.5-0.6-5.3 0-12.7 10.3-23.1 23.1-23.1 6.6 0 12.6 2.8 16.9 7.3 5.2-1 10.2-2.9 14.6-5.6 -1.7 5.4-5.4 9.9-10.1 12.7 4.6-0.5 9.1-1.8 13.3-3.6C109.6 26.2 105.7 30.3 101.2 33.6z"/></svg>'; break;

		}

		return $return;

	} // get_svg()

	/**
	 * Returns the sharing URL for the requested service
	 *
	 * @since 		1.0.0
	 * @param 		string 		$network 		The service name
	 * @return 		string          			The sharing URL for the requested service
	 */
	private function get_url( $network ) {

		$return = '';

		switch ( $network ) {

			case 'Email': 		$return = 'mailto:?subject=' . get_the_title() . '&body=' . get_the_excerpt(); break;
			case 'Facebook': 	$return = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ); break;
			case 'Google': 		$return = 'https://plus.google.com/share?url=' . urlencode( get_permalink() ); break;
			case 'LinkedIn': 	$return = 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_permalink() ) . '&title=' . get_the_title() . '&summary=' . get_the_excerpt() . '&source=' . urlencode( get_permalink() ); break;
			case 'Pinterest': 	$return = 'https://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&description=' . get_the_excerpt() . '&media=' . wp_get_attachment_url( get_post_thumbnail_id() ); break;
			case 'Reddit': 		$return = 'http://www.reddit.com/submit?url=' . urlencode( get_permalink() ) . '&title=' . get_the_title() . ''; break;
			case 'tumblr': 		$return = 'http://www.tumblr.com/share'; break;
			case 'Twitter': 	$return = 'https://twitter.com/intent/tweet?text=' . get_the_title() . '&url=' . urlencode( get_permalink() ) . '&via=dccmarketing'; break;

		}

		return $return;

	} // get_defaults()

}

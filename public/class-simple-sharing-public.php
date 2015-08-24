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
	 * @var 		string 			$plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @var 		string 			$plugin_name 		The name of the plugin.
	 * @var 		string 			$version 				The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_options();

	}

	/**
	 * Adds sharing buttons to the bottom of posts
	 *
	 * If any of the following conditions are true, return the unaltered text:
	 * 		post is empty
	 *   	its a preview
	 *    	its home
	 * 	   	its the front page
	 *      its a feed
	 *      its an excerpt
	 *      its not the main query
	 *      its a singular post of a type, but the box for that type isn't checked
	 *      The current filter isn't 'the_content'
	 * Otherwise, return the $text with the sharing button at the bottom
	 *
	 * @todo  		Make this selectable in plugin options
	 *
	 * @access 		public
	 * @since 		1.0.0
	 * @global 		$post 						The post
	 * @global 		$wp_current_filter 			The filters
	 * @global 		$wp_post_types 				All the currently registered post types
	 * @param 		mixed 		$content 		The current content
	 * @return 		mixed 						The altered content
	 */
	public function add_sharing_buttons( $text ) {

		global $post, $wp_current_filter, $wp_post_types;

		if ( empty( $post ) ||
			is_preview() ||
			is_home() ||
			is_front_page() ||
			is_feed() ||
			in_array( 'get_the_excerpt', (array) $wp_current_filter ) ||
			! is_main_query()
		) {

			return $text;

		}

		$skip = false;

		foreach ( $wp_post_types as $post_type ) {

			if ( empty( $post_type->public ) ) { continue; }

			if ( $post_type->name == $post->post_type && is_singular( $post_type->name ) && empty( $this->options['auto-' . $post_type->name ] ) ) {

				$skip = true;

			}

		}

		if ( $skip ) { return $text; }

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

		return $text . $this->shortcode();

	} // add_sharing_buttons()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-sharing-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-sharing-public.min.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Returns a clean, custom-created excerpt
	 *
	 * @param 	string 		$text 			The post
	 * @param 	int 		$length 		How many words to include in the excerpt
	 * @return 	string 						The excerpt
	 */
	private function get_custom_excerpt( $text, $length = 55 ) {

		if ( empty( $text ) ) { return 'Text is empty'; }

		return wp_trim_words( $text, $length );

	} // get_custom_excerpt()

	/**
	 * Returns the correct URL to use for the Email button
	 *
	 * The other buttons use esc_url(), which breaks the
	 * formatting of posts (removes spaces between words).
	 *
	 * @return 	string 				The mailto URL
	 */
	private function get_email_url() {

		$excerpt 			= wp_strip_all_tags( $this->get_custom_excerpt( get_the_content() ) );
		$args['subject'] 	= rawurlencode( get_the_title() );
		$args['body'] 		= $excerpt . '%0A%0A' . get_permalink();
		$base_url 			= 'mailto:';


		return add_query_arg( $args, $base_url );

	} // get_email_url()

	/**
	 * Returns the correct screen reader span based on the button type plugin setting
	 *
	 * @since 	1.0.0
	 * @param  	string 			$button 		The service name
	 * @return 	string|mixed 				 	The label or SVG icon
	 */
	private function get_reader_text( $button ) {

		$return 	= '';

		switch( $this->options['button-type'] ) {

			case 'text': $return = esc_html__( 'Share on', 'simple-sharing' ); break;
			case 'icon': $return = sprintf( esc_html__( 'Share on %s', 'simple-sharing' ), $button ); break;

		} // switch

		return $return;

	} // get_reader_text()

	/**
	 * Returns the sharing URL for the requested service
	 *
	 * @since 		1.0.0
	 * @param 		string 		$button 		The service name
	 * @return 		string          			The sharing URL
	 */
	private function get_url( $button ) {

		if ( 'Email' == $button ) {

			return $this->get_email_url();

		}

		$return 	= '';
		$title 		= urlencode( get_the_title() );
		$excerpt 	= urlencode( get_the_excerpt() );
		$link 		= urlencode( get_permalink() );
		$image 		= urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) );
		$args 		= array();
		$base_url 	= '';

		switch ( $button ) {

			case 'Facebook':
				// https://www.facebook.com/sharer/sharer.php?u=' . $link
				$args['u'] 				= $link;
				$base_url 				= 'https://www.facebook.com/sharer/sharer.php';
			break;

			case 'Google':
				// https://plus.google.com/share?url=' . $link
				$args['url'] 			= $link;
				$base_url 				= 'https://plus.google.com/share';
			break;

			case 'LinkedIn':
				// https://www.linkedin.com/shareArticle?mini=true&url=' . $link . '&title=' . $title . '&summary=' . $excerpt . '&source=' . $link
				$args['mini'] 			= 'true';
				$args['url'] 			= $link;
				$args['title'] 			= $title;
				$args['summary'] 		= $excerpt;
				$args['source'] 		= $link;
				$base_url 				= 'https://www.linkedin.com/shareArticle';
			break;

			case 'Pinterest':
				// https://pinterest.com/pin/create/button/?url=' . $link . '&description=' . $excerpt . '&media=' . $image
				$args['url'] 			= $link;
				$args['description'] 	= $excerpt;
				$args['media'] 			= $image;
				$base_url 				= 'https://pinterest.com/pin/create/button/';
			break;

			case 'Reddit':
			 	// http://www.reddit.com/submit?url=' . $link . '&title=' . $title
				$args['url'] 			= $link;
				$args['title'] 			= $title;
				$base_url 				= 'http://www.reddit.com/submit';
			break;

			case 'tumblr':
				//
				$args['canonicalUrl'] 	= $link;
				$args['title'] 			= $title;
				$args['content'] 		= $excerpt;

				if ( ! empty( $this->options['account-tumblr'] ) ) {

					$args['show-via'] 	= $this->options['account-tumblr'];

				}

				$base_url 				= 'https://www.tumblr.com/widgets/share/tool';
			break;

			case 'Twitter':
				// https://twitter.com/intent/tweet?text=' . $title . '&url=' . $link . '&via=dccmarketing'
				$args['text'] 			= $title;
				$args['url'] 			= $link;

				if ( ! empty( $this->options['account-twitter'] ) ) {

					$args['via'] 		= $this->options['account-twitter'];

				}

				$base_url 				= 'https://twitter.com/intent/tweet';
			break;

		} // switch

		$return = esc_url( add_query_arg( $args, $base_url ) );

		return $return;

	} // get_url()

	/**
	 * Registers all shortcodes
	 */
	public function register_shortcodes() {

		add_shortcode( 'simplesharingbuttons', array( $this, 'shortcode' ) );

	} // register_shortcodes()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Processes shortcode
	 *
	 * @param   array	$atts		The attributes from the shortcode
	 * @return	mixed	$output		Output of the buffer
	 */
	public function shortcode( $atts = array() ) {

		ob_start();

		include( plugin_dir_path( __FILE__ ) . 'partials/simple-sharing-public-display.php' );

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode()

} // class

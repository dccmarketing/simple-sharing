<?php

/**
 * Shared methods
 *
 * @link 		http://slushman.com
 * @since 		1.0.0
 *
 * @package		Simple_Sharing
 * @subpackage 	Simple_Sharing/includes
 */

class Simple_Sharing_Shared {

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
	 * @var 		string 			$plugin_name 			The name of this plugin.
	 * @var 		string 			$version 				The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->set_options();

	} // __construct()

	/**
	 * Returns an array of the buttons
	 *
	 * @return 		array 								The list of buttons
	 */
	public function get_button_array() {

		$buttons 	= $this->options['button-order'];
		$list 		= explode( ',', $buttons );

		return $list;

	} // get_button_array()

	/**
	 * Returns the button label based on the plugin setting
	 *
	 * @since 	1.0.0
	 * @param  	string 			$button 		The service name
	 * @return 	string|mixed 				 	The label or SVG icon
	 */
	public function get_label( $button ) {

		$return = '';

		switch( $this->options['button-type'] ) {

			case 'text': $return = '<span class="btn-text">' . $button . '</span>'; break;
			case 'icon': $return = $this->get_svg( $button ); break;

		} // switch

		return $return;

	} // get_label()

	/**
	 * Returns the correct screen reader span based on the button type plugin setting
	 *
	 * @since 	1.0.0
	 * @param  	string 			$button 		The service name
	 * @return 	string|mixed 				 	The label or SVG icon
	 */
	public function get_reader_text( $button ) {

		$return 	= '';

		switch( $this->options['button-type'] ) {

			case 'text': $return = esc_html__( 'Share on', 'simple-sharing' ); break;
			case 'icon': $return = sprintf( esc_html__( 'Share on %s', 'simple-sharing' ), $button ); break;

		} // switch

		return $return;

	} // get_reader_text()

	/**
	 * Returns the requested SVG icon
	 *
	 * @since 		1.0.0
	 * @param 		string 			$button 			The service name
	 * @return 		mixed 								The requested SVG icon
	 */
	public function get_svg( $button ) {

		$return = '';

		switch ( $button ) {

			case 'Baidu' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="baidu"><path d="M17.1 11.9c-2.4.1-2.5-1.6-2.5-2.8s.3-3 2.2-3 2.4 1.9 2.4 2.5c.1.6.3 3.2-2.1 3.3zm-4.3-5.5c-1.6-.2-2-1.6-1.8-3.1.1-1.2 1.6-3 2.7-2.7s2.2 1.8 2 3c-.2 1.3-1.2 3-2.9 2.8zm0 3.6c1.5 2.1 4 4 4 4s1.9 1.4.7 4.2c-1.2 2.8-5.6 1.3-5.6 1.3s-1.6-.5-3.5-.1-3.5.3-3.5.3-2.2.1-2.8-2.7c-.6-2.7 2.2-4.2 2.4-4.5.2-.3 1.7-1.2 2.6-2.8.9-1.5 3.7-2.7 5.7.3zM7.6 6.2c-1.2 0-2.2-1.4-2.2-3.1S6.4 0 7.6 0s2.2 1.4 2.2 3.1-1 3.1-2.2 3.1zm-4.1 4.3c-2.2.5-3-2-2.8-3.2 0 0 .3-2.5 2-2.7C4.1 4.5 5.1 6 5.3 6.9c.1.6.4 3.2-1.8 3.6z"/></svg>'; break;
			case 'Buffer' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="buffer"><path d="M9.7.5c.3 0 .6 0 .9.1 2.8 1.3 5.6 2.6 8.5 4 .1.1.2.1.2.3 0 .2-.1.2-.3.3-2.8 1.3-5.7 2.6-8.5 4-.4.1-.8.1-1.2 0-2.8-1.3-5.7-2.6-8.5-4 0-.1-.1-.2-.1-.4 0-.1.1-.2.3-.3C3.7 3.3 6.4 2 9.1.7c.2-.1.4-.2.6-.2zM2.8 8.9c.3-.1.7 0 1 .1 1.8.9 3.7 1.7 5.5 2.6.4.2.9.2 1.3.1 1.9-.9 3.7-1.7 5.6-2.6.4-.2 1-.2 1.4 0 .5.2 1 .5 1.5.7.1.1.3.2.2.3 0 .1-.2.2-.3.3-2.8 1.3-5.6 2.6-8.5 3.9-.4.2-.9.2-1.4-.1-2.8-1.3-5.5-2.6-8.3-3.9-.1-.1-.3-.1-.3-.3 0-.1.1-.2.2-.3l1.2-.6c.4 0 .6-.2.9-.2z"/><path d="M2.9 14c.3 0 .6 0 .9.2 1.8.8 3.6 1.7 5.5 2.5.4.2.9.2 1.3.1 1.9-.9 3.9-1.8 5.8-2.7.4-.2.9-.1 1.3.1.5.2 1 .5 1.5.7.1.1.2.2.1.4-.1.1-.3.2-.5.3-2.7 1.3-5.4 2.5-8.1 3.8-.4.2-.9.2-1.3.1-2.8-1.3-5.5-2.6-8.3-3.9-.2-.1-.3-.1-.4-.3-.1-.1 0-.3.2-.3.4-.2.8-.4 1.3-.6.2-.2.4-.4.7-.4z"/></svg>'; break;
			case 'Delicious' 	: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="delicious"><path d="M19.5 15.9c0 2-1.6 3.6-3.6 3.6H4.1c-2 0-3.6-1.6-3.6-3.6V4.1C.5 2.1 2.1.5 4.1.5H16c2 0 3.6 1.6 3.6 3.6v11.8zm-.8-5.9H10V1.3H4.1c-1.5 0-2.8 1.2-2.8 2.8V10H10v8.7h5.9c1.5 0 2.8-1.2 2.8-2.8V10z"/></svg>'; break;
			case 'Digg' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="digg"><path d="M5.2 4.1v9.5H.1V6.8h3.2V4.1h1.9zM3.3 8.4H2.1V12h1.2V8.4zM6 6h2V4H6v2zm0 7.6h2V6.8H6v6.8zm8-6.8v9.1H8.8v-1.6H12v-.8H8.8V6.8H14zm-2 1.6h-1.2V12H12V8.4zm7.9-1.6v9.1h-5.1v-1.6H18v-.8h-3.2V6.8h5.1zm-2 1.6h-1.2V12h1.2V8.4z"/></svg>'; break;
			case 'Douban' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="douban"><path d="M.2 19.4v-1.8h4.9l-1.5-4.8H1.9l.2-8.6h15.8v8.5h-1.7l-1.3 4.8 4.8-.2.1 2H.2v.1zm7.9-1.8h3.6l1.7-4.8h-7l1.7 4.8zm6.7-10.9H5.2l-.1 3.7h9.7V6.7zM.8.6H19v1.8H.8V.6z"/></svg>'; break;
			case 'Email' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="email"><path d="M19 14.5v-9q0-.62-.44-1.06T17.5 4H3.49q-.62 0-1.06.44T1.99 5.5v9q0 .62.44 1.06t1.06.44H17.5q.62 0 1.06-.44T19 14.5zm-1.31-9.11q.15.15.175.325t-.04.295-.165.22L13.6 9.95l3.9 4.06q.26.3.06.51-.09.11-.28.12t-.28-.07l-4.37-3.73-2.14 1.95-2.13-1.95-4.37 3.73q-.09.08-.28.07t-.28-.12q-.2-.21.06-.51l3.9-4.06-4.06-3.72q-.1-.1-.165-.22t-.04-.295.175-.325q.4-.4.95.07l6.24 5.04 6.25-5.04q.55-.47.95-.07z"/></svg>'; break;
			case 'Facebook' 	: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="facebook"><path d="M8.46 18h2.93v-7.3h2.45l.37-2.84h-2.82V6.04q0-.69.295-1.035T12.8 4.66h1.51V2.11Q13.36 2 12.12 2q-1.67 0-2.665.985T8.46 5.76v2.1H6v2.84h2.46V18z"/></svg>'; break;
			case 'Google' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="googleplus"><path d="M2.8 4.9c2.3-1.7 5.7-1.5 7.8.5-.6.5-1.1 1.1-1.7 1.6-1.6-1.4-4.2-1.2-5.5.4-1.6 1.8-1.1 4.9 1 6.1 2 1.2 5 .2 5.5-2.2H6.3V9.1h6c.2 1.8-.2 3.8-1.4 5.2-1.5 1.8-4.2 2.4-6.4 1.7-2.1-.6-3.9-2.5-4.3-4.7-.5-2.4.5-5 2.6-6.4zM16.3 7.3h1.8v1.8h1.8v1.8h-1.8v1.8h-1.8v-1.8h-1.8V9.1h1.8V7.3z"/></svg>'; break;
			case 'LinkedIn' 	: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="linkedin"><path d="M2.5 5C1 5 .1 4 .1 2.8.1 1.6 1.1.6 2.5.6c1.5 0 2.4 1 2.4 2.2C4.9 4 4 5 2.5 5zm2.1 14.4H.4V6.7h4.2v12.7zm15.3 0h-4.2v-6.8c0-1.7-.6-2.9-2.1-2.9-1.2 0-1.9.8-2.2 1.5-.1.3-.1.7-.1 1v7.1H6.9c.1-11.4 0-12.6 0-12.6h4.2v1.9c.6-.9 1.6-2.1 3.8-2.1 2.8 0 4.9 1.8 4.9 5.7v7.2z"/></svg>'; break;
			case 'Pinterest'	: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="pinterest"><path d="M10.5.1c3.7 0 7.1 2.6 7.1 6.5 0 3.7-1.9 7.8-6.1 7.8-1 0-2.2-.5-2.7-1.4-.9 3.6-.8 4.1-2.8 6.8l-.2.1-.1-.1c-.1-.7-.2-1.5-.2-2.2 0-2.4 1.1-5.9 1.7-8.3-.3-.6-.4-1.3-.4-2 0-1.2.8-2.7 2.2-2.7 1 0 1.5.8 1.5 1.7 0 1.5-1 3-1 4.5 0 1 .8 1.7 1.8 1.7 2.7 0 3.6-3.9 3.6-6 0-2.8-2-4.3-4.7-4.3C7 2.1 4.6 4.3 4.6 7.5c0 1.5.9 2.3.9 2.7 0 .3-.2 1.4-.6 1.4h-.2C3 11 2.4 8.8 2.4 7.2c0-4.4 4-7.1 8.1-7.1z"/></svg>'; break;
			case 'QZone'		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="qzone"><path d="M14.6 12.4l.5 1.5c-1.7-.2-4.2-.4-6.4-.8-.1-.3 6.1-4.6 6-4.9-5.5-.9-9.6 0-9.6 0l6.7.9s-6.3 4.2-6.4 4.6c2.8.5 7.3.5 9.8.4.6 1.9 1.4 4.6.9 4.9-1.2.6-6.3-3.3-6.3-3.3s-5 3.6-5.8 3.2c-1.2-.6.5-6.6.5-6.6S-.1 8.6.2 7.7c.3-.9 7-1.2 7-1.2S9.1 1.2 10 1s3 5.2 3 5.2 6.4.7 6.8 1.3c.4.5-5.2 4.9-5.2 4.9zM17 14s-.7 0-1.9.1c0-.1-.1-.2-.1-.2 1.3.1 2 .1 2 .1z"/></svg>'; break;
			case 'Reddit' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="reddit"><path d="M19.9 9.8c0-1.3-1-2.3-2.3-2.3-.6 0-1.1.2-1.5.6-1.5-1-3.5-1.6-5.7-1.7l1.1-3.7 3.3.7c0 1 .8 1.9 1.9 1.9s1.9-.8 1.9-1.9-.8-1.9-1.9-1.9c-.8 0-1.4.5-1.7 1.1L11.5 2c-.2 0-.4.1-.4.2L9.8 6.4c-2.2 0-4.4.6-6 1.7-.4-.4-.9-.6-1.5-.6C1 7.5 0 8.5 0 9.8c0 .8.4 1.5 1.1 1.9 0 .2-.1.4-.1.6 0 1.6.9 3.1 2.7 4.3 1.7 1.1 3.9 1.7 6.2 1.7 2.4 0 4.6-.6 6.2-1.7 1.7-1.1 2.7-2.6 2.7-4.3 0-.2 0-.4-.1-.6.8-.4 1.2-1.1 1.2-1.9zm-3.1-7.5c.6 0 1.2.5 1.2 1.2 0 .6-.5 1.2-1.2 1.2-.6 0-1.2-.5-1.2-1.2 0-.6.6-1.2 1.2-1.2zM.8 9.8c0-.9.7-1.6 1.6-1.6.3 0 .6.1.9.3-1 .7-1.6 1.6-2 2.5-.3-.3-.5-.7-.5-1.2zm9.2 7.9c-4.5 0-8.2-2.4-8.2-5.3V12c0-.2.1-.5.1-.7.4-.8.9-1.6 1.8-2.3.2-.1.4-.3.6-.4 1.4-.9 3.5-1.5 5.7-1.5s4.3.6 5.7 1.5c.2.1.4.3.6.4.8.6 1.4 1.4 1.7 2.3.1.2.1.5.1.7v.4c.1 2.9-3.6 5.3-8.1 5.3zm8.7-6.7c-.3-.9-1-1.8-1.9-2.5.2-.2.6-.3.9-.3.9 0 1.6.7 1.6 1.6-.1.5-.3.9-.6 1.2z"/><path d="M12.7 14.7c-.7.6-1.5.8-2.7.8-1.2 0-2-.2-2.7-.8-.2-.1-.4-.1-.5.1-.1.2-.1.4.1.5.8.7 1.8 1 3.2 1s2.4-.3 3.2-1c.2-.1.2-.4.1-.5-.3-.2-.5-.3-.7-.1zM8.4 11.3c0-.7-.6-1.3-1.4-1.3-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.8.1 1.4-.5 1.4-1.3zM13 10c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3.7 0 1.3-.6 1.3-1.3.1-.7-.5-1.3-1.3-1.3z"/></svg>'; break;
			case 'Renren' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="renren"><path d="M.4 9.9c0-1.6.3-3 1-4.4S3.1 3 4.3 2.1 6.9.6 8.4.4v6.1c0 2.1-.5 4-1.6 5.7-1.1 1.7-2.4 3-4.1 3.8C1.2 14.3.4 12.3.4 9.9zm5 8.4c1.1-.7 2.1-1.6 2.9-2.6.8-1 1.4-2.1 1.6-3.3.3 1.2.8 2.3 1.7 3.3.8 1 1.8 1.9 2.9 2.6-1.4.8-3 1.2-4.6 1.2-1.6 0-3.1-.4-4.5-1.2zm6.2-11.7V.5c1.5.2 2.8.8 4.1 1.7s2.2 2 2.9 3.4 1 2.8 1 4.4c0 2.3-.8 4.4-2.3 6.2-1.7-.8-3.1-2.1-4.1-3.8s-1.6-3.7-1.6-5.8z"/></svg>'; break;
			case 'Stumbleupon' 	: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="stumbleupon"><path d="M11.1 6.9c0-.6-.5-1.1-1.1-1.1s-1.1.5-1.1 1.1v6.3c0 2.4-2 4.4-4.4 4.4-2.4 0-4.4-2-4.4-4.4v-2.7h3.4v2.7c0 .6.5 1.1 1.1 1.1.6 0 1.1-.5 1.1-1.1V6.7c0-2.4 2-4.3 4.4-4.3 2.4 0 4.4 1.9 4.4 4.3v1.4l-2 .6-1.4-.6V6.9zm8.8 3.5v2.7c0 2.4-2 4.4-4.4 4.4-2.4 0-4.4-2-4.4-4.4v-2.8l1.4.6 2-.6v2.8c0 .6.5 1 1.1 1 .6 0 1.1-.5 1.1-1v-2.8h3.2z"/></svg>'; break;
			case 'tumblr' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="tumblr"><path d="M15.7 18.7c-.4.5-2 1.1-3.4 1.2-4.3.1-5.9-3.1-5.9-5.3V8.1h-2V5.6c3-1.1 3.7-3.8 3.9-5.3 0-.1.1-.1.1-.1h2.9v5h4v3h-4v6.1c0 .8.3 2 1.9 1.9.5 0 1.2-.2 1.6-.3l.9 2.8z"/></svg>'; break;
			case 'Twitter' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="twitter"><path d="M18.94 4.46q-.75 1.12-1.83 1.9.01.15.01.47 0 1.47-.43 2.945T15.38 12.6t-2.1 2.39-2.93 1.66-3.66.62q-3.04 0-5.63-1.65.48.05.88.05 2.55 0 4.55-1.57-1.19-.02-2.125-.73T3.07 11.55q.39.07.69.07.47 0 .96-.13-1.27-.26-2.105-1.27T1.78 7.89v-.04q.8.43 1.66.46-.75-.51-1.19-1.315T1.81 5.25q0-1 .5-1.84Q3.69 5.1 5.655 6.115T9.87 7.24q-.1-.45-.1-.84 0-1.51 1.075-2.585T13.44 2.74q1.6 0 2.68 1.16 1.26-.26 2.33-.89-.43 1.32-1.62 2.02 1.07-.11 2.11-.57z"/></svg>'; break;
			case 'VK' 			: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="vk"><path d="M18.3 8.2c-2 2.7-2.2 2.4-.6 3.9s1.9 2.2 2 2.3c0 0 .7 1.2-.7 1.2h-2.6c-.6.1-1.3-.4-1.3-.4-1-.7-1.9-2.4-2.6-2.2 0 0-.7.2-.7 1.8 0 .3-.2.5-.2.5s-.2.2-.5.2H9.8c-2.6.2-4.9-2.2-4.9-2.2S2.4 10.7.2 5.5C.1 5.2.2 5 .2 5s.2-.2.6-.2h2.8c.3.1.4.2.4.2s.2.1.2.3c.5 1.2 1.1 2.2 1.1 2.2C6.3 9.6 7 10 7.4 9.8c0 0 .5-.3.4-2.9 0-.9-.3-1.4-.3-1.4-.1-.2-.6-.3-.8-.3-.2 0 .1-.4.4-.6.5-.2 1.4-.3 2.5-.2.8 0 1.1.1 1.4.1 1 .2.6 1.1.6 3.3 0 .7-.1 1.7.4 2 .2.1.8 0 2.1-2.2 0 0 .6-1.1 1.1-2.3.1-.3.3-.3.3-.3s.2-.1.4-.1h3c.9-.1 1 .3 1 .3.1.4-.4 1.4-1.6 3z"/></svg>'; break;
			case 'Weibo' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="weibo"><path d="M19.6 8.8c-.1.4-.6.6-1 .5-.4-.1-.6-.6-.5-1 .4-1.2.1-2.6-.8-3.6S15 3.3 13.8 3.6c-.3.1-.7-.2-.8-.6-.1-.4.2-.8.6-.9 1.8-.4 3.7.2 5 1.6 1.2 1.5 1.6 3.4 1 5.1zM14.4 6c-.4.1-.7-.1-.8-.5-.1-.4.1-.7.5-.8.9-.2 1.8.1 2.4.8.6.7.8 1.7.5 2.5-.1.3-.5.5-.8.4-.3-.1-.5-.5-.4-.8.1-.4 0-.9-.3-1.2-.2-.4-.7-.5-1.1-.4zm.3 1.2c.3.5.3 1.2 0 2-.1.4 0 .4.3.5 1.1.4 2.4 1.2 2.4 2.7 0 2.5-3.6 5.6-9 5.6-4.1 0-8.3-2-8.3-5.3C.1 11 1.2 9 3 7.1c2.5-2.5 5.4-3.6 6.5-2.5.5.5.6 1.4.3 2.4-.2.5.5.2.5.2 2-.8 3.7-.9 4.4 0zm-.7 5.2c-.2-2.2-3-3.6-6.3-3.3-3.3.3-5.8 2.3-5.5 4.5.2 2.2 3 3.6 6.3 3.3 3.2-.4 5.7-2.4 5.5-4.5zm-7.7 3.5c-1.6-.5-2.2-2.1-1.6-3.5.7-1.4 2.4-2.2 4-1.7 1.6.4 2.4 1.9 1.8 3.4-.6 1.5-2.6 2.3-4.2 1.8zm.9-2.9c-.5-.2-1.2 0-1.5.5-.3.5-.2 1.1.3 1.3.5.2 1.2 0 1.5-.5.4-.5.2-1.1-.3-1.3zm1.2-.5c-.2-.1-.4 0-.6.2-.1.2 0 .4.1.5.2.1.5 0 .6-.2.2-.2.1-.5-.1-.5z"/></svg>'; break;
			case 'Xing' 		: $return = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="xing"><path d="M5.6 13.4c-.1.3-.3.6-.8.6H2c-.2 0-.3-.1-.4-.2-.1-.1-.1-.3 0-.4l3-5.4-1.9-3.4c-.1-.2-.1-.3 0-.4.1-.2.2-.2.4-.2H6c.4 0 .6.3.8.5l2 3.4s-.2.3-3.2 5.5zM18.4.7l-6.3 11.2 4 7.4c.1.2.1.3 0 .4-.1.1-.2.2-.4.2h-2.9c-.4 0-.7-.3-.8-.5l-4-7.5s.2-.4 6.4-11.3c.2-.3.3-.5.8-.5H18c.2 0 .3.1.4.2.1.1.1.2 0 .4z"/></svg>'; break;

		}

		return $return;

	} // get_svg()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

} // class
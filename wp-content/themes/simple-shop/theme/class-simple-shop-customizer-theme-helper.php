<?php
/**
* Simple Shop Theme Helper (A helper class to determine information about the current theme)
*/

// Bail if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;


final class Simple_Shop_Theme_Helper {
	/**
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * @var Simple_Shop_Theme_Helper, Instance of the class
	 */
	protected static $_instance;

	/**
	 * @var WP_Theme
	 */
	public $theme = false;

	/**
	 * @var WP_Theme
	 */
	public $child_theme = false;

	/**
	 * Function used to create instance of class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();

		return self::$_instance;
	}


	/**
	 * This function sets up all of the actions and filters on instance. It also loads (includes)
	 * the required files and assets.
	 */
	function __construct( ) {
		// Hooks
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 999 ); // After Setup Theme (late; but before Simple_Shop_Customizer_Typography class)
	}

	/**
	 * This function initiates the calls to get the details of the current theme.
	 */
	function after_setup_theme() {
		$this->theme = $this->get_parent_theme(); // Get the [parent] theme
		$this->child_theme = $this->get_child_theme(); // Get the child theme
	}

	/**
	 * This function returns the details of the current [parent] theme.
	 */
	public function get_parent_theme() {
		// Return the cached version of the theme
		if ( is_a( $this->theme, 'WP_Theme' ) )
			return $this->theme;

		$wp_get_theme = wp_get_theme();

		return ( is_child_theme() ) ? $wp_get_theme->parent() : $wp_get_theme ;
	}

	/**
	 * This function returns the details of the current child theme (if any).
	 */
	public function get_child_theme() {
		// Return the cached version of the theme or null (if not a child theme)
		if ( is_a( $this->child_theme, 'WP_Theme' ) || $this->child_theme === null )
			return $this->child_theme;

		return ( is_child_theme() ) ? wp_get_theme() : null;
	}
}

/**
 * Create an instance of the Simple_Shop_Theme_Helper class.
 */
function Simple_Shop_Theme_Helper() {
	return Simple_Shop_Theme_Helper::instance();
}

Simple_Shop_Theme_Helper();
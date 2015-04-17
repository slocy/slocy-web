<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library Demo
 */

/**
 * Enqueue Google Fonts Example
 */
function customizer_topshop_theme_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'topshop-body-font', customizer_library_get_default( 'topshop-body-font' ) ),
		get_theme_mod( 'topshop-heading-font', customizer_library_get_default( 'topshop-heading-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'customizer_topshop_theme_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'customizer_topshop_theme_fonts' );
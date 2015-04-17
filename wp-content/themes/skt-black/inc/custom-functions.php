<?php
/**
 * @package SKT Black
 * Setup the WordPress core custom functions feature.
 *
*/

add_action('admin_enqueue_scripts', 'skt_black_optionsframework_custom_scripts');
	function skt_black_optionsframework_custom_scripts( $hook ) {
    if ( 'appearance_page_black-options' != $hook ) {
        return;
    }
    wp_enqueue_script( 'skt-black-option-script', get_template_directory_uri().'/js/optionframework-custom.js' );
}
	

// custom javascript for head
function skt_black_hook_custom_javascript(){
	wp_enqueue_script('skt_black_cus', get_template_directory_uri().'/js/hook-custom-script.js');	
}
add_action('wp_enqueue_scripts','skt_black_hook_custom_javascript');


function skt_black_is_google_font( $font ){
	$notGoogleFont = array( 'Arial', 'Comic Sans MS', 'FreeSans', 'Georgia', 'Lucida Sans Unicode', 'Palatino Linotype', 'Symbol', 'Tahoma', 'Trebuchet MS', 'Verdana' );
	if( in_array($font, $notGoogleFont) ){
		return false;
	}else{
		return true;
	}
}

// subhead section function
function skt_black_sub_head_section( $more ) {
	$pgs = 0;
	do {
		$pgs++;
	} while ($more > $pgs);
	return $pgs;
}


// remove excerpt more
function skt_black_new_excerpt_more( $more ) {
	return '... ';
}
add_filter('excerpt_more', 'skt_black_new_excerpt_more');

// get post categories function
function skt_black_getPostCategories(){
	$categories = get_the_category();
	$catOut = '';
	$separator = ', ';
	$catOutput = '';
	if($categories){
		foreach($categories as $category) {
			$catOutput .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'skt-black' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
		}
		$catOut = 'Categories: '.trim($catOutput, $separator);
	}
	return $catOut;
}


define('SKT_SITE_URL','http://www.sktthemes.net'); 
define('SKT_THEME_URL','http://www.sktthemes.net/themes');
define('SKT_PRO_THEME_URL','http://www.sktthemes.net/themes/skt-black-pro/');
define('SKT_THEME_DOC','http://sktthemesdemo.net/documentation/skt-black-doc/');
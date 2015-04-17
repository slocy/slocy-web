<?php
/**
 * SKT Black functions and definitions
 *
 * @package SKT Black
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
 


if ( ! function_exists( 'skt_black_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_black_setup() {

	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'skt-black', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_image_size('skt-black-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-black' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => '000000'
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // skt_black_setup
add_action( 'after_setup_theme', 'skt_black_setup' );


function skt_black_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-black' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-black' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'skt_black_widgets_init' );

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once get_template_directory() . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );


function skt_black_font_url(){
		$font_url = '';
		
		/* Translators: If there are any character that are
		* not supported by Roboto, translate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on', 'Roboto font:on or off','skt-black');
		
		/* Translators: If there are any character that are not
		* supported by Open sans, trsnalate this to off, do not
		* translate into your own language.
		*/
		$open_sans = _x('on','Open Sans:on or off','skt-black');
		
		/* Translators: If there has any character that are not supported 
		*  by Roboto Condensed, translate this to off, do not translate
		*  into your own language.
		*/
		$roboto_condensed = _x('on','Roboto Condensed:on or off','skt-black');
		
		if('off' !== $roboto || 'off' !== $open_sans || 'off' !== $roboto_condensed){
			$font_family = array();
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:400,600,700,800,900';
			}
			
			if('off' !== $open_sans){
				$font_family[] = 'Open Sans:300,400,600,700';
			}
			
			if('off' !== $roboto_condensed){
				$font_family[] = 'Roboto Condensed:300,400,700,800';
			}
			
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}

function skt_black_scripts() {
	wp_enqueue_style('skt-black-font', skt_black_font_url(), array());
	wp_enqueue_style( 'skt_black-basic-style', get_stylesheet_uri() );
	wp_enqueue_style('skt_black-responsive-tyle', get_template_directory_uri().'/css/theme-responsive.css');
	wp_enqueue_style( 'skt_black-editor-style', get_template_directory_uri().'/editor-style.css' );
	wp_enqueue_style( 'skt_black-base-style', get_template_directory_uri().'/css/style_base.css' );
	wp_enqueue_style( 'skt_black-nivo-style', get_template_directory_uri().'/css/nivo-slider.css' );
	wp_enqueue_script( 'skt_black-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'skt_black-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery') );
	wp_enqueue_script( 'skt_black-nivo-scripts', get_template_directory_uri().'/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'skt-black-lightbox', get_template_directory_uri() . '/js/slimbox2.js', array('jquery') );
	wp_enqueue_style( 'skt_black-animation-style', get_template_directory_uri().'/css/animation.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_black_scripts' );

function skt_black_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('skt-black-ie', get_template_directory_uri().'/css/ie.css', array('skt-black-style'));
	$wp_styles->add_data('skt-black-ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','skt_black_ie_stylesheet');


// add favicon to head
function skt_black_favicon(){
	if( of_get_option('favicon',true) != ''){ ?>
    <link rel="icon" href="<?php echo esc_url(of_get_option('favicon',true)); ?>" />
    <?php
	}
}
add_action('wp_head','skt_black_favicon');


function skt_black_custom_head_codes() { 
	if ( function_exists('of_get_option') ){
		if ( of_get_option('style2', true) != '' ) {
			echo "<style>". esc_html( of_get_option('style2', true) ) ."</style>";
		}
		echo "<style>";
		if ( of_get_option('colorscheme', true) != '' ) {
			echo '.top-bar a, .contact-banner a, input.search-submit, .post-password-form input[type=submit], #services-box:hover, .icon:hover, .newsletter-form input[type="submit"]{background-color:'. esc_html( of_get_option('colorscheme', true) ) .';}';
		}
		if( of_get_option('colorscheme',true) != ''){
			echo ".header .header-inner .nav ul li a:hover, .newsletter h2 span, .recent-post li span, .phone-no strong, a{color:". esc_html(of_get_option('colorscheme',true))."}";
		}
		if( of_get_option('colorscheme',true) != ''){
			echo "#some-facts li{border:2px solid ".esc_html(of_get_option('colorscheme',true))."}";
		}
		if( of_get_option('colorscheme',true) != ''){
			echo ".more:hover{background:".esc_html(of_get_option('colorscheme',true))." url(".get_template_directory_uri()."/images/white-arrow.png) no-repeat scroll center center}";
		}
		echo "</style>";
	}
}
add_action('wp_head', 'skt_black_custom_head_codes');


function skt_black_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load custom functions file.
 */
require get_template_directory() . '/inc/custom-functions.php';


// get slug by id
function skt_black_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

// Excerpt length function
function skt_black_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'skt_black_excerpt_length', 999 );
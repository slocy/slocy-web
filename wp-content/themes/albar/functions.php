<?php
/**
 * alba functions and definitions
 *
 * @package Albar
 */

define( 'KAIRA_THEME_VERSION' , '1.6.4' );

if ( file_exists( get_stylesheet_directory() . '/settings/class.kaira-theme-settings.php' ) ) {
    require_once( get_stylesheet_directory() . '/settings/class.kaira-theme-settings.php' );
}

// Theme Widgets
include get_template_directory() . '/includes/widgets.php';

if ( ! function_exists( 'kaira_setup_theme' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function kaira_setup_theme() {
    
    /**
     * Set the content width based on the theme's design and stylesheet.
     */
    global $content_width;
    if ( ! isset( $content_width ) )
        $content_width = 870; /* pixels */

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Alba, use a find and replace
	 * to change 'albar' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'albar', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'main-menu' => __( 'Main Menu', 'albar' )
	) );

	add_theme_support('post-thumbnails');
    if ( function_exists( 'add_image_size' ) ) {
        add_image_size('blog_standard_img', 580, 380, true );
    }
	
	// The custom header is used for the logo
	add_theme_support('custom-header', array(
        'default-image' => '',
		'width'         => 290,
		'height'        => 110,
		'flex-width' => false,
		'flex-height' => false,
		'header-text' => false,
	));
	
	add_editor_style();

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
    add_theme_support( 'custom-background', array( 'default-color' => '#ffffff', ) );
    
    add_theme_support( 'title-tag' );
    
    add_theme_support( 'woocommerce' );
}
endif; // kaira_setup
add_action( 'after_setup_theme', 'kaira_setup_theme' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function kaira_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'albar' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar(array(
		'name' => __('Alba Footer', 'albar'),
		'id' => 'site-footer',
	));
	
    register_widget( 'alba_carousel' );
    register_widget( 'alba_heading' );
    register_widget( 'alba_icon' );
}
add_action( 'widgets_init', 'kaira_widgets_init' );

if(!function_exists('kaira_footer_widget_params')):
/**
 * Set the widths of the footer widgets
 *
 * @param $params
 * @return mixed
 * 
 * @filter dynamic_sidebar_params
 */
function kaira_footer_widget_params($params){
	// Check that this is the footer
	if($params[0]['id'] != 'site-footer') return $params;

	$sidebars_widgets = wp_get_sidebars_widgets();
	$count = count($sidebars_widgets[$params[0]['id']]);
	$params[0]['before_widget'] = preg_replace('/\>$/', ' style="width:'.round(100/$count,4).'%" >', $params[0]['before_widget']);

	return $params;
}
endif;
add_filter('dynamic_sidebar_params', 'kaira_footer_widget_params');

function kaira_print_styles(){
    $custom_css = '';
    if ( kaira_theme_option( 'kra-custom-css' ) ) {
        $custom_css = kaira_theme_option( 'kra-custom-css' );
    }
    
    $body_font = kaira_theme_option( 'kra-body-google-font-name' );
    $body_font_color = kaira_theme_option( 'kra-body-google-font-color' );
    $h_font = kaira_theme_option( 'kra-heading-google-font-name' );
    $h_font_color = kaira_theme_option( 'kra-heading-google-font-color' );
    
    $primary_color = kaira_theme_option( 'kra-primary-color' );
    $primary_color_hover = kaira_theme_option( 'kra-primary-color-hover' ); ?>
    <style type="text/css" media="screen">
        body,
        .page-header h1,
        .alba-banner-heading h5,
        .alba-carousel-block,
        .alba-heading-text {
            color: <?php echo $body_font_color; ?>;
            <?php echo ( $body_font ) ? $body_font : 'font-family: \'Open Sans\', sans-serif;'; ?>
        }
        h1, h2, h3, h4, h5, h6,
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
            color: <?php echo $h_font_color; ?>;
            <?php echo ( $h_font ) ? $h_font : 'font-family: \'Roboto\', sans-serif;'; ?>
        }
        
        .alba-button,
        .post .alba-blog-permalink-btn,
        .search article.page .alba-blog-permalink-btn,
        .wpcf7-submit,
        
        #alba-home-slider-prev,
        #alba-home-slider-next,
        .alba-carousel-arrow-prev,
        .alba-carousel-arrow-next {
            background-color: <?php echo $primary_color; ?>;
        }
        .site-header-one .site-title a,
        .site-header-two .site-title a,
        
        .site-header-one .site-top-bar i,
        .site-header-two .site-social i,
        
        .navigation-main li:hover > a,
        li.current_page_item > a,
        li.current_page_ancestor > a,
        
        .page-header .cx-breadcrumbs a,
        
        .sidebar-navigation-left .current_page_item,
        .sidebar-navigation-right .current_page_item,
        
        .entry-content a,
        .alba-blog-standard-block a,
        .widget ul li a,
        #comments .logged-in-as a,
        .alba-heading i,
        .alba-heading b,
        .alba-banner-heading h3 b {
            color: <?php echo $primary_color; ?>;
        }
        .navigation-main li.current_page_item,
        .navigation-main li.current_page_ancestor {
            border-bottom: 2px solid <?php echo $primary_color; ?>;
        }
        .navigation-main ul ul {
            border-top: 2px solid <?php echo $primary_color; ?>;
        }
        .alba-button:hover,
        .wpcf7-submit:hover,
        .post .alba-blog-permalink-btn:hover,
        .search article.page .alba-blog-permalink-btn:hover,
        
        #alba-home-slider-prev:hover,
        #alba-home-slider-next:hover,
        .alba-carousel-arrow-prev:hover,
        .alba-carousel-arrow-next:hover {
            background-color: <?php echo $primary_color_hover; ?>;
        }
        .entry-content a:hover,
        h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
        .alba-blog-standard-block a:hover,
        #comments .logged-in-as a:hover,
        .widget .tagcloud a:hover,
        .sidebar-navigation ul li a:hover,
        .cx-breadcrumbs a:hover,
        .widget ul li a:hover {
            color: <?php echo $primary_color_hover; ?>;
        }
        .sidebar-navigation-left .current_page_item {
            box-shadow: 3px 0 0 <?php echo $primary_color; ?> inset;
        }
        .sidebar-navigation-right .current_page_item {
            box-shadow: -3px 0 0 <?php echo $primary_color; ?> inset;
        }
        <?php echo htmlspecialchars_decode( $custom_css ); ?>
    </style>
    <?php
}
add_action('wp_head', 'kaira_print_styles', 11);

/**
 * Enqueue scripts and styles
 */
function kaira_scripts() {
    if( kaira_theme_option( 'kra-body-google-font-url' ) ) {
        wp_enqueue_style( 'albar-google-font-body', kaira_theme_option( 'kra-body-google-font-url' ), array(), KAIRA_THEME_VERSION );
    } else {
        wp_enqueue_style( 'albar-google-body-font-default', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic', array(), KAIRA_THEME_VERSION );
    }
    if( kaira_theme_option( 'kra-heading-google-font-url' ) ) {
        wp_enqueue_style( 'albar-google-font-heading', kaira_theme_option( 'kra-heading-google-font-url' ), array(), KAIRA_THEME_VERSION );
    } else {
        wp_enqueue_style( 'albar-google-heading-font-default', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic', array(), KAIRA_THEME_VERSION );
    }
    
    wp_enqueue_style( 'albar-fontawesome', get_template_directory_uri().'/includes/font-awesome/css/font-awesome.css', array(), '4.0.3' );
	wp_enqueue_style( 'albar-style', get_stylesheet_uri(), array(), KAIRA_THEME_VERSION );
    
	wp_enqueue_script( 'albar-navigation', get_template_directory_uri() . '/js/navigation.js', array(), KAIRA_THEME_VERSION, true );
	wp_enqueue_script( 'albar-caroufredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), KAIRA_THEME_VERSION, true );
    
	wp_enqueue_script( 'albar-customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'), KAIRA_THEME_VERSION, true );
    
	wp_enqueue_script( 'albar-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), KAIRA_THEME_VERSION, true );
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'kaira-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), KAIRA_THEME_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'kaira_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/inc/customizer.php';

/**
 * Add Alba wrappers around WooCommerce pages content.
 */
add_action('woocommerce_before_main_content', 'kaira_wrap_woocommerce_start', 10);
add_action('woocommerce_after_main_content', 'kaira_wrap_woocommerce_end', 10);
function kaira_wrap_woocommerce_start() {
    echo '<div id="primary" class="content-area content-area-full">';
}
function kaira_wrap_woocommerce_end() {
    echo '</div>';
}

// Create function to check if WooCommerce exists.
if ( ! function_exists( 'kaira_is_woocommerce_activated' ) ) :
    
function kaira_is_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
}

endif; // kaira_is_woocommerce_activated

if ( kaira_is_woocommerce_activated() ) {
    require get_template_directory() . '/includes/inc/woocommerce-inc.php';
}

/* Display the recommended plugins notice that can be dismissed */
add_action('admin_notices', 'kaira_recommended_plugin_notice');

function kaira_recommended_plugin_notice() {
    global $pagenow;
    global $current_user;
    
    $user_id = $current_user->ID;
    
    /* If on plugins page, check that the user hasn't already clicked to ignore the message */
    if ( $pagenow == 'plugins.php' ) {
        if ( ! get_user_meta( $user_id, 'kaira_recommended_plugin_ignore_notice' ) ) {
            echo '<div class="updated"><p>';
            printf( __('<p>Install the plugins we at <a href="http://www.kairaweb.com/" target="_blank">Kaira</a> recommended | <a href="%1$s">Hide Notice</a></p>'), '?kaira_recommended_plugin_nag_ignore=0' ); ?>
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'SiteOrigin\'s Page Builder', 'kaira' ), 'WordPress' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'Contact Form 7', 'kaira' ), 'WordPress' ); ?></a><br />
            <a href="<?php echo admin_url('plugin-install.php?tab=favorites&user=kaira'); ?>"><?php printf( __( 'Breadcrumb NavXT', 'kaira' ), 'WordPress' ); ?></a>
            <?php
            echo "</p></div>";
        }
    }
}
add_action('admin_init', 'kaira_recommended_plugin_nag_ignore');

function kaira_recommended_plugin_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
        
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset($_GET['kaira_recommended_plugin_nag_ignore']) && '0' == $_GET['kaira_recommended_plugin_nag_ignore'] ) {
        add_user_meta( $user_id, 'kaira_recommended_plugin_ignore_notice', 'true', true );
    }
}
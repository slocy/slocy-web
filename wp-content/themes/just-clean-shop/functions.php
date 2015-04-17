<?php
add_action( 'after_setup_theme', 'JustCleanShop_setup' );
function JustCleanShop_setup() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(166, 124, TRUE);
	if ( ! isset( $content_width ) )
	$content_width = 960;
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_action( 'wp_enqueue_scripts', 'JustCleanShop_frontend' );
	add_theme_support( 'woocommerce' );
	add_image_size( 'JustCleanShop-logo-size', 330, 100, true );
    add_theme_support( 'site-logo', array( 'size' => 'JustCleanShop-logo-size' ) );
    load_theme_textdomain( 'JustCleanShop', get_template_directory() . '/languages' );
}
function JustCleanShop_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'JustCleanShop_styles' );
function JustCleanShop_widgets() {
	register_sidebar( array(
    'name' => __( 'Sidebar Left', 'JustCleanShop' ),  	    
    'id'   => 'sidebar-left',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Head', 'JustCleanShop' ),        'id'   => 'sidebar-head',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 1', 'JustCleanShop' ),    'id'   => 'sidebar-footer1',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 2', 'JustCleanShop' ),    'id'   => 'sidebar-footer2',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 3', 'JustCleanShop' ),    'id'   => 'sidebar-footer3',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 4', 'JustCleanShop' ),    'id'   => 'sidebar-footer4',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 5', 'JustCleanShop' ),    'id'   => 'sidebar-footer5',
	) );
}
add_action( 'widgets_init', 'JustCleanShop_widgets' );
add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'));
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3;
	}
}
function woocommerce_output_related_products() {
    $args = array('posts_per_page' => 3, 'columns' => 3,'orderby' => 'JustCleanShop_related_products' );
    woocommerce_related_products( apply_filters( 'JustCleanShop_related_products', $args ) );}
function JustCleanShop_frontend() {
 	wp_enqueue_style( 'JustCleanShop-style', get_stylesheet_uri() );
}
function JustCleanShop_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 3 || $page >= 3 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'JustCleanShop' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'JustCleanShop_wp_title', 10, 3 );

function JustCleanShop_comment() {	if ( is_singular() ) wp_enqueue_script( "comment-reply" );}    add_action( 'wp_enqueue_scripts', 'JustCleanShop_comment' );
add_action( 'wp_enqueue_scripts', 'JustCleanShop_tag_cloud' );
function JustCleanShop_tag_cloud( $tags ){
    return preg_replace(
        "~ style='font-size: (\d+)pt;'~",
        ' class="tag-cloud-size-\10"',
        $tags
    );
}
add_filter('add_to_cart_fragments', 'JustCleanShop_fragment');
function JustCleanShop_fragment( $fragments ) 
{
    global $woocommerce;
    ob_start(); ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'JustCleanShop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'JustCleanShop'), $woocommerce->cart->cart_contents_count);?> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
function JustCleanShop_menu() {
	add_theme_page('JustCleanShop Setup', __( 'Theme Help', 'JustCleanShop' ), 'edit_theme_options', 'JustCleanShop', 'JustCleanShop_menu_page');
}
add_action('admin_menu', 'JustCleanShop_menu');
function JustCleanShop_menu_page() {
echo '
<br>
<h1>' . __( '7 Sidebar for theme Just Clean Shop', 'JustCleanShop' ) . '</h1><br><br>
<br>
<img src="' . get_template_directory_uri() . '/images/jcshop-sidebar.jpg">
<br><br><br>
<h1>' . __( 'Site  ', 'JustCleanShop' ) . ' <a href="http://justpx.com/product/just-clean-shop-free/">' . __( 'Just Clean Shop free', 'JustCleanShop' ) . '</a> -  ' . __( 'documentation (Logo, favicon, font, ...).', 'JustCleanShop' ) . '</h1><br><br>
<h1>' . __( 'Site ', 'JustCleanShop' ) . ' <a href="http://justpx.com/product/just-clean-shop-pro/">' . __( 'Just Clean Shop PRO ', 'JustCleanShop' ) . '</a> - ' . __( 'theme, demo, documentation.', 'JustCleanShop' ) . '<br><br>
' . __( 'Localization Ready: English, French, German, Italian, Russian. Add', 'JustCleanShop' ) . ' <a href="http://justpx.com/your-language">' . __( 'Your language', 'JustCleanShop' ) . '</a>. <br/><br/></h1>
<br><br>
<img src="' . get_template_directory_uri() . '/images/pro-vs-free.png">
';
}
function JustCleanShop_menu2() {
	add_theme_page('JustCleanShop Setup', __( 'Premium Upgrade', 'JustCleanShop' ), 'edit_theme_options', 'JustCleanShoppro', 'JustCleanShop_menu_page2');
}
add_action('admin_menu', 'JustCleanShop_menu2');
function JustCleanShop_menu_page2() {
echo '
<br>
<h1>' . __( 'Theme Just Clean Shop PRO', 'JustCleanShop' ) . '</h1></ceter><br>
<img src="' . get_template_directory_uri() . '/images/pro-vs-free.png">
<h1>' . __( 'Site', 'JustCleanShop' ) . ' <a href="http://justpx.com/product/just-clean-shop-pro/" target="_blank">' . __( 'Just Clean Shop PRO', 'JustCleanShop' ) . '</a> - ' . __( 'theme, demo, documentation.', 'JustCleanShop' ) . '</h1><br><br>
<h1>' . __( '10% Discount - Code:', 'JustCleanShop' ) . ' justpx10</h1></ceter>
<br/><br/><br/><br/>
';
}
function JustCleanShop_my_menu() {
	register_nav_menu( 'menu-id', __( 'Primary Menu', 'JustCleanShop'  ) );
}
add_action( 'init', 'JustCleanShop_my_menu' );
?>
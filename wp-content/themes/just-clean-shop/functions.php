<?php
add_action( 'after_setup_theme', 'just_clean_shop_setup' );
function just_clean_shop_setup() {
	register_nav_menu( 'menu-id', __( 'Primary Menu', 'just-clean-shop'  ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(223, 167, TRUE);
	global $content_width;
	if ( ! isset( $content_width ) )
	$content_width = 960;
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_action( 'wp_enqueue_scripts', 'just_clean_shop_frontend' );
	add_theme_support( 'woocommerce' );
	add_image_size( 'just_clean_shop-logo-size', 330, 100, true );
    add_theme_support( 'site-logo', array( 'size' => 'just_clean_shop-logo-size' ) );
    load_theme_textdomain( 'just-clean-shop', get_template_directory() . '/languages' );
}
function just_clean_shop_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'just_clean_shop_styles' );
function just_clean_shop_widgets() {
	register_sidebar( array(
    'name' => __( 'Sidebar Left', 'just-clean-shop' ),  	  'id'   => 'sidebar-left',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Head', 'just-clean-shop' ),        'id'   => 'sidebar-head',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 1', 'just-clean-shop' ),    'id'   => 'sidebar-footer1',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 2', 'just-clean-shop' ),    'id'   => 'sidebar-footer2',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 3', 'just-clean-shop' ),    'id'   => 'sidebar-footer3',
	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 4', 'just-clean-shop' ),    'id'   => 'sidebar-footer4',	) );
	register_sidebar( array(
    'name' => __( 'Sidebar Footer 5', 'just-clean-shop' ),    'id'   => 'sidebar-footer5',	) );
}
add_action( 'widgets_init', 'just_clean_shop_widgets' );
add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'));
add_filter('loop_shop_columns', 'just_clean_shop_loop_columns');
if (!function_exists('just_clean_shop_loop_columns')) {
	function just_clean_shop_loop_columns() {
		return 3;
	}
}
function woocommerce_output_related_products() {
    $args = array('posts_per_page' => 3, 'columns' => 3,'orderby' => 'rand' );
    woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );}
function just_clean_shop_frontend() {
 	wp_enqueue_style( 'just_clean_shop-style', get_stylesheet_uri() );
}
function just_clean_shop_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 3 || $page >= 3 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'just-clean-shop' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'just_clean_shop_wp_title', 10, 3 );

function just_clean_shop_comment() {	if ( is_singular() ) wp_enqueue_script( "comment-reply" );}    add_action( 'wp_enqueue_scripts', 'just_clean_shop_comment' );
add_action( 'wp_enqueue_scripts', 'just_clean_shop_tag_cloud' );
function just_clean_shop_tag_cloud( $tags ){
    return preg_replace(
        "~ style='font-size: (\d+)pt;'~",
        ' class="tag-cloud-size-\10"',
        $tags
    );
}
add_filter('add_to_cart_fragments', 'just_clean_shop_fragment');
function just_clean_shop_fragment( $fragments ) 
{
    global $woocommerce;
    ob_start(); ?>
    <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'just-clean-shop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'just-clean-shop'), $woocommerce->cart->cart_contents_count);?> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
function just_clean_shop_menu() {
	add_theme_page('just_clean_shop Setup', __( 'Theme Help and PRO', 'just-clean-shop' ), 'edit_theme_options', 'just-clean-shop', 'just_clean_shop_menu_page');
}
add_action('admin_menu', 'just_clean_shop_menu');
function just_clean_shop_menu_page() {
echo '
<br>
<center><h1>' . __( '7 Sidebars for theme Just Clean Shop free', 'just-clean-shop' ) . '</h1><br><br>
<br>
<img src="' . get_template_directory_uri() . '/images/jcshop-sidebar.jpg">
<br><br><br>
<h1>' . __( 'Site  ', 'just-clean-shop' ) . ' <a href="http://justpx.com/product/just-clean-shop-free/">' . __( 'Just Clean Shop free', 'just-clean-shop' ) . '</a> -  ' . __( 'documentation (Logo, favicon, font, ...).', 'just_clean_shop' ) . '</h1><br><br>
<h1>' . __( 'Site ', 'just-clean-shop' ) . ' <a href="http://justpx.com/product/just-clean-shop-pro/">' . __( 'Just Clean Shop PRO ', 'just-clean-shop' ) . '</a> - ' . __( 'theme, demo, documentation.', 'just_clean_shop' ) . '<br><br>
' . __( 'Localization Ready: English, French, German, Italian, Russian, ... . Add', 'just-clean-shop' ) . ' <a href="http://justpx.com/your-language">' . __( 'Your language', 'just_clean_shop' ) . '</a>. <br/><br/></h1>
<br><br>
<img src="' . get_template_directory_uri() . '/images/pro-vs-free.png">
<br>
<br>
<br>
<br>
<br>
<br>
</br>
</br>
</br>
<center><h1 style="font-size:50px;">' . __( 'Theme Just Clean Shop PRO + Bonus', 'just-clean-shop' ) . '</h1></ceter></br></br></br></br>
<img src="' . get_template_directory_uri() . '/images/just-clean-shop-1.jpg"></br></br></br><img src="' . get_template_directory_uri() . '/images/just-clean-sidebar-home-page-1.png"></br></br></br><img src="' . get_template_directory_uri() . '/images/just-clean-shop-right.jpg"></br></br></br><img src="' . get_template_directory_uri() . '/images/just-clean-sidebar-home-page-right.png"></br></br></br></br></br><img src="' . get_template_directory_uri() . '/images/1.png"></br></br></br><img src="' . get_template_directory_uri() . '/images/2.png"></br></br></br><img src="' . get_template_directory_uri() . '/images/3.png"></br></br></br></br></br><img src="' . get_template_directory_uri() . '/images/just-clean-shop-bonus.jpg"></br></br></br></br></br><img src="' . get_template_directory_uri() . '/images/jcshop-sidebar-bonus.png"></br></br></br><br>
<h1 style="font-size:26px;">' . __( 'Site', 'just-clean-shop' ) . ' <a href="http://justpx.com/product/just-clean-shop-pro/" target="_blank">' . __( 'Just Clean Shop PRO', 'just-clean-shop' ) . '</a> - ' . __( 'theme, demo, documentation.', 'just_clean_shop' ) . '</h1><br><br>
<h1 style="font-size:26px;">' . __( '10% Discount - Code:', 'just-clean-shop' ) . ' justpx10</h1></ceter>
<br/><br/><br/><br/>
';
}
?>
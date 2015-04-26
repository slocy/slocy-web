<?php

/**
 * This class manages all functionality with our Simple Shop theme.
 */
class Simple_Shop {
	/**
	 * @var string
	 */
	public $version = '1.1.1';

	private static $instance; // Keep track of the instance

	/**
	 * Function used to create instance of class.
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/*
	 * This function sets up all of the actions and filters on instance
	 */
	function __construct() {
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 20 ); // Register image sizes
		add_action( 'widgets_init', array( $this, 'widgets_init' ), 20 ); // Unregister sidebars
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) ); // Add Meta Boxes
		add_action( 'dynamic_sidebar_params', array( $this, 'dynamic_sidebar_params' ) ); // Filter Dynamic Sidebar Parameters (Note Widgets)
		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) ); // Used to enqueue editor styles based on post type
		add_action( 'wp_head', array( $this, 'wp_head' ), 1 ); // Add <meta> tags to <head> section
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) ); // Enqueue all stylesheets (Main Stylesheet, Fonts, etc...)
		add_filter( 'wp_nav_menu_items', array( $this, 'wp_nav_menu_items' ), 10, 2 ); // Add WooCommerce/EDD cart menu items to top nav menu
		add_filter( 'the_content_more_link', '__return_false' ); // Remove default more link
		add_action( 'wp_footer', array( $this, 'wp_footer' ) ); // Responsive navigation functionality

		// Gravity Forms
		add_filter( 'gform_field_input', array( $this, 'gform_field_input' ), 10, 5 ); // Add placholder to newsletter form
		add_filter( 'gform_confirmation', array( $this, 'gform_confirmation' ), 10, 4 ); // Change confirmation message on newsletter form

		// WooCommerce
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 ); // Remove default WooCommerce content wrapper
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 ); // Remove default WooCommerce content wrapper
		add_action( 'woocommerce_before_main_content', array( $this, 'woocommerce_before_main_content' ) ); // Add WooCommerce content wrapper
		add_action( 'woocommerce_after_main_content', array( $this, 'woocommerce_after_main_content' ) ); // Add WooCommerce content wrapper
		add_action( 'woocommerce_sidebar', array( $this, 'woocommerce_sidebar' ), 999 ); // Add WooCommerce closing content wrapper
		add_filter( 'woocommerce_product_settings', array( $this, 'woocommerce_product_settings' ) ); // Adjust default WooCommerce product settings
		add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 ); // Adjust number of items displayed on a catalog page
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 ); // Remove default WooCommerce related products
		add_action( 'woocommerce_after_single_product_summary', array( $this, 'woocommerce_after_single_product_summary' ), 20 ); // Add WooCommerce related products (3x3)
		add_filter( 'loop_shop_columns', array( $this, 'woocommerce_loop_columns' ), 999 ); // Changes WooCommerce loop columns to 3
		add_filter( 'woocommerce_get_image_size_shop_single', array( $this, 'woocommerce_get_image_size_shop_single' ) ); // Sets size of main image on single product page
		add_filter( 'woocommerce_get_image_size_shop_thumbnail', array( $this, 'woocommerce_get_image_size_shop_thumbnail' ) ); // Sets size of thumbnail images on single product page
		add_filter( 'woocommerce_get_image_size_shop_catalog', array( $this, 'woocommerce_get_image_size_shop_catalog' ) ); // Sets size of thumbnail images on single product page
		add_filter( 'woocommerce_placeholder_img', array( $this, 'woocommerce_placeholder_img' ) );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
		add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail' );
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'woocommerce_before_shop_loop_item' ) );
		add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash' );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'woocommerce_after_shop_loop_item' ) );

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) )
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'woocommerce_add_to_cart_fragments' ) );
		else
			add_filter( 'add_to_cart_fragments', array( $this, 'woocommerce_add_to_cart_fragments' ) );
	}


	/************************************************************************************
	 *    Functions to correspond with actions above (attempting to keep same order)    *
	 ************************************************************************************/

	/**
	 * This function adds images sizes to WordPress.
	 */
	function after_setup_theme() {
		global $content_width;

		/**
		 * Set the Content Width for embedded items.
		 */
		if ( ! isset( $content_width ) )
			$content_width = 868;

		// WooCommerce Support
		add_theme_support( 'woocommerce' );

		// Change default core markup for search form, comment form, and comments, etc... to HTML5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list'
		) );

		// Custom Background (color/image)
		add_theme_support( 'custom-background', array(
			'default-color' => '#000',
			'default-image' => get_template_directory_uri() . '/images/pattern.png'
		) );

		// Theme textdomain
		load_theme_textdomain( 'simple-shop', get_template_directory() . '/languages' );

		add_image_size( 'simple-shop-800x500', 800, 500, true ); // Recent Posts Widget
		add_image_size( 'simple-shop-800x800', 800, 650, true ); // WooCommerce Single Product
		add_image_size( 'simple-shop-425x280', 425, 280, true ); // Blog Post
		add_image_size( 'simple-shop-1400x600', 1400, 600, false ); // Single Post
		add_image_size( 'simple-shop-1600x9999', 1600, 9999, false ); // Single Page

		// Unregister unused menus which are registered in SDS Core
		unregister_nav_menu( 'footer_nav' );
	}

	/**
	 * This function unregisters extra sidebars that are not used in this theme.
	 */
	function widgets_init() {
		global $wp_registered_sidebars;

		// Unregister unused sidebars which are registered in SDS Core
		unregister_sidebar( 'secondary-sidebar' );
		//unregister_sidebar( 'front-page-sidebar' );
		unregister_sidebar( 'header-call-to-action-sidebar' );
		// unregister after posts sidebar
		unregister_sidebar( 'after-posts-sidebar' );

		// Add a span to surround the widget title
		$wp_registered_sidebars['front-page-slider-sidebar']['before_title'] = '<h3 class="block-title"><span class="fancy">';
		$wp_registered_sidebars['front-page-slider-sidebar']['after_title'] = '</span></h3>';
		$wp_registered_sidebars['front-page-sidebar']['before_title'] = '<h3 class="block-title"><span class="fancy">';
		$wp_registered_sidebars['front-page-sidebar']['after_title'] = '</span></h3>';
	}

	/**
	 * This function adds CSS classes to Note widgets.
	 */
	function dynamic_sidebar_params( $params ) {
		global $wp_registered_widgets;

		// Bail if Note doesn't exist
		if ( ! function_exists( 'Note_Widget' ) )
			return $params;

		// Note Widget instance
		$note_widget = Note_Widget();

		// Only on Note Widgets
		if ( $params[0]['widget_name'] === $note_widget->name ) {
			$the_note_widget = $wp_registered_widgets[$params[0]['widget_id']];

			// Determine if we can get the instance
			if ( is_array( $the_note_widget['callback'] ) && is_a( $the_note_widget['callback'][0], 'Note_Widget' ) ) {
				$instance = $the_note_widget['callback'][0]->get_settings(); // Get all Note widget settings
				if ( array_key_exists( $params[1]['number'], $instance ) )
					$instance = $instance[$params[1]['number']];

				// If we have an instance
				if ( ! empty( $instance ) && isset( $instance['css_class'] ) && $instance['css_class'] ) {
					$css_classes = explode( ' ', $instance['css_class'] );

					// Append container suffix to end of classes
					foreach ( $css_classes as &$css_class )
						$css_class .= '-container';

					$css_classes = implode( ' ', $css_classes );

					// Add classes to $before_widget
					$params[0]['before_widget'] = str_replace( 'class="', 'class="' . $css_classes . ' ', $params[0]['before_widget'] );
				}
			}
		}

		return $params;
	}

	/**
	 * This function runs when meta boxes are added.
	 */
	function add_meta_boxes() {
		// Post types
		$post_types = get_post_types(
			array(
				'public' => true,
				'_builtin' => false
			)
		);
		$post_types[] = 'post';
		$post_types[] = 'page';

		// Add the metabox for each type
		foreach ( $post_types as $type ) {
			add_meta_box(
				'simple-shop-us-metabox',
				__( 'Layout Settings', 'simple-shop' ),
				array( $this, 'simple_shop_us_metabox' ),
				$type,
				'side',
				'default'
			);
		}
	}

	/**
	 * This function renders a metabox.
	 */
	function simple_shop_us_metabox( $post ) {
		// Get the post type label
		$post_type = get_post_type_object( $post->post_type );
		$label = ( isset( $post_type->labels->singular_name ) ) ? $post_type->labels->singular_name : __( 'Post', 'simple-shop' );

		echo '<p class="howto">';
		printf(
			__( 'Looking to configure a unique layout for this %1$s? <a href="%2$s" target="_blank">Upgrade to Pro</a>.', 'simple-shop' ),
			esc_html( strtolower( $label ) ),
			esc_url( sds_get_pro_link( 'metabox-layout-settings' ) )
		);
		echo '</p>';
	}

	/**
	 * This function adds editor styles based on post type, before TinyMCE is initalized.
	 * It will also enqueue the correct color scheme stylesheet to better match front-end display.
	 */
	function pre_get_posts() {
		global $sds_theme_options, $post;

		$protocol = is_ssl() ? 'https' : 'http';

		// Admin only
		if ( is_admin() ) {
			add_editor_style( 'css/editor-style.css' );

			// Add correct color scheme if selected
			if ( function_exists( 'sds_color_schemes' ) && ! empty( $sds_theme_options['color_scheme'] ) && $sds_theme_options['color_scheme'] !== 'default' ) {
				$color_schemes = sds_color_schemes();
				add_editor_style( 'css/' . $color_schemes[ $sds_theme_options['color_scheme'] ]['stylesheet'] );
			}

			// Droid Sans Web Font (include only if a web font is not selected in Theme Options)
			if ( ! function_exists( 'sds_web_fonts' ) || empty( $sds_theme_options['web_font'] ) )
				add_editor_style( str_replace( ',', '%2C', $protocol . '://fonts.googleapis.com/css?family=Droid+Sans:400,700' ) ); // Google WebFonts (Droid Sans)


			// Fetch page template if any on Pages only
			if ( ! empty( $post ) && $post->post_type === 'page' )
				$wp_page_template = get_post_meta( $post->ID,'_wp_page_template', true );

			// Admin only and if we have a post using our full page or landing page templates
			if ( ( isset( $wp_page_template ) && ( $wp_page_template === 'template-full-width.php' || $wp_page_template === 'template-landing-page.php' ) ) )
				add_editor_style( 'css/editor-style-full-width.css' );
		}
	}

	/**
	 * This function adds <meta> tags to the <head> element.
	 */
	function wp_head() {
	?>
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<?php
	}

	/**
	 * This function enqueues all styles and scripts (Main Stylesheet, Fonts, etc...). Stylesheets can be conditionally included if needed.
	 */
	function wp_enqueue_scripts() {
		global $sds_theme_options, $is_IE;

		$protocol = is_ssl() ? 'https' : 'http'; // Determine current protocol

		// Simple Shop (main stylesheet)
		wp_enqueue_style( 'simple-shop', get_template_directory_uri() . '/style.css', false, $this->version );

		// Enqueue the child theme stylesheet only if a child theme is active
		if ( is_child_theme() )
			wp_enqueue_style( 'simple-shop-child', get_stylesheet_uri(), array( 'simple-shop' ), $this->version );

		// Droid Sans (include only if a web font is not selected in Theme Options)
		if ( ! function_exists( 'sds_web_fonts' ) || empty( $sds_theme_options['web_font'] ) )
			wp_enqueue_style( 'droid-sans-web-font', $protocol . '://fonts.googleapis.com/css?family=Droid+Sans:400,700', false, $this->version );

		// Google WebFonts (Fugaz One)
		wp_enqueue_style( 'fugaz-one-web-font', $protocol . '://fonts.googleapis.com/css?family=Fugaz+One', false, $this->version ); // Google WebFonts  (Fugaz One)

		// Dashicons (used as placeholder featured image)
		wp_enqueue_style( 'dashicons' );

		// Ensure jQuery is loaded on the front end for our footer script (@see wp_footer() below)
		wp_enqueue_script( 'jquery' );

		// Fitvids
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), $this->version );

		// HTML5 Shiv (IE only)
		if ( $is_IE )
			wp_enqueue_script( 'html5-shiv', get_template_directory_uri() . '/js/html5.js', false, $this->version );
	}

	/**
	 * This function adds the WooCommerce or Easy Digital Downloads cart icons/items to the top_nav
	 * menu area as the last item.
	 */
	function wp_nav_menu_items( $items, $args, $ajax = false ) {

		// Top Navigation area only
		if ( ( isset( $ajax ) && $ajax ) || ( property_exists( $args, 'theme_location' ) && $args->theme_location === 'top_nav' ) ) {
			// WooCommerce
			if ( class_exists( 'woocommerce' ) ) {
				$css_class = 'menu-item menu-item-type-cart menu-item-type-woocommerce-cart';

				// Is this the cart page?
				if ( is_cart() )
					$css_class .= ' current-menu-item';

				$items .= '<li class="' . esc_attr( $css_class ) . '">';
					$items .= '<a class="cart-contents" href="' . esc_url( WC()->cart->get_cart_url() ) . '">';
						$items .= wp_kses_data( WC()->cart->get_cart_total() ) . ' - <span class="count">' .  wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'simple-shop' ), WC()->cart->get_cart_contents_count() ) ) . '</span>';
					$items .= '</a>';
				$items .= '</li>';
			}
			// Easy Digital Downloads
			else if ( class_exists( 'Easy_Digital_Downloads' ) ) {
				$css_class = 'menu-item menu-item-type-cart menu-item-type-edd-cart';

				// Is this the cart page?
				if ( edd_is_checkout() )
					$css_class .= ' current-menu-item';

				$items .= '<li class="' . esc_attr( $css_class ) . '">';
					$items .= '<a class="cart-contents" href="' . esc_url( edd_get_checkout_uri() ) . '">';
						$items .= wp_kses_data( edd_cart_subtotal() ) . ' - <span class="count">' .  wp_kses_data( sprintf( _n( '%d item', '%d items', edd_get_cart_quantity(), 'simple-shop' ), edd_get_cart_quantity() ) ) . '</span>';
					$items .= '</a>';
				$items .= '</li>';
			}
		}

		return $items;
	}

	/**
	 * This function outputs the necessary javascript for the responsive menus.
	 */
	function wp_footer() {
	?>
		<script type="text/javascript">
			// <![CDATA[
				jQuery( function( $ ) {
					// Primary Nav
					$( '.primary-nav-button' ).on( 'click', function (e) {
						e.stopPropagation();
						$( '.primary-nav-button, .primary-nav' ).toggleClass( 'open' );
					} );

					$( document ).on('click touch', function () {
						$( '.primary-nav-button, .primary-nav' ).removeClass( 'open' );
					} );

					// Fitvids
					$( 'article.content, .widget' ).fitVids();
				} );
			// ]]>
		</script>
	<?php
	}


	/*****************
	 * Gravity Forms *
	 *****************/

	/**
	 * This function adds the HTML5 placeholder attribute to forms with a CSS class of the following:
	 * .mc-gravity, .mc_gravity, .mc-newsletter, .mc_newsletter classes
	 */
	function gform_field_input( $input, $field, $value, $lead_id, $form_id ) {
		$form_meta = RGFormsModel::get_form_meta( $form_id ); // Get form meta

		// Ensure we have at least one CSS class
		if ( isset( $form_meta['cssClass'] ) ) {
			$form_css_classes = explode( ' ', $form_meta['cssClass'] );

			// Ensure the current form has one of our supported classes and alter the field accordingly if we're not on admin
			if ( ! is_admin() && array_intersect( $form_css_classes, array( 'mc-gravity', 'mc_gravity', 'mc-newsletter', 'mc_newsletter' ) ) )
				$input = '<div class="ginput_container"><input name="input_' . $field['id'] . '" id="input_' . $form_id . '_' . $field['id'] . '" type="text" value="" class="large" placeholder="' . $field['label'] . '" /></div>';
		}

		return $input;
	}

	/**
	 * This function alters the confirmation message on forms with a CSS class of the following:
	 * .mc-gravity, .mc_gravity, .mc-newsletter, .mc_newsletter classes
	 */
	function gform_confirmation( $confirmation, $form, $lead, $ajax ) {
		// Ensure we have at least one CSS class
		if ( isset( $form['cssClass'] ) ) {
			$form_css_classes = explode( ' ', $form['cssClass'] );

			// Confirmation message is set and form has one of our supported classes (alter the confirmation accordingly)
			if ( $form['confirmation']['type'] === 'message' && array_intersect( $form_css_classes, array( 'mc-gravity', 'mc_gravity', 'mc-newsletter', 'mc_newsletter' ) ) )
				$confirmation = '<div class="mc-gravity-confirmation mc_gravity-confirmation mc-newsletter-confirmation mc_newsletter-confirmation">' . $confirmation . '</div>';
		}

		return $confirmation;
	}


	/***************
	 * WooCommerce *
	 ***************/

	/**
	 * This function alters the default WooCommerce content wrapper starting element.
	 */
	function woocommerce_before_main_content() {
	?>
		<section class="woocommerce woo-commerce content-container cf">

			<article class="content cf">
				<section class="post-container">
	<?php
	}

	/**
	 * This function alters the default WooCommerce content wrapper ending element.
	 */
	function woocommerce_after_main_content() {
	?>
				</section>
	<?php
	}

	/**
	 * This function adds to the default WooCommerce content wrapper ending element.
	 */
	function woocommerce_sidebar() {
	?>
			</article>
		</section>
	<?php
	}

	/**
	 * This function adjusts the default WooCommerce Product settings.
	 */
	function woocommerce_product_settings( $settings ) {
		if ( is_array( $settings ) )
			foreach ( $settings as &$setting ) // Adjust the default value of the Catalog image size
				if ( $setting['id'] === 'shop_catalog_image_size' )
					$setting['default']['width'] = $setting['default']['height'] = 300;

		return $settings;
	}

	/**
	 * This function changes the number of products output on the Catalog page.
	 */
	function loop_shop_per_page( $num_items ) {
		return 12;
	}

	/**
	 * This function changes the number of related products displayed on a single product page.
	 */
	function woocommerce_after_single_product_summary() {
		woocommerce_related_products( array(
			'posts_per_page' => 3,
			'columns' => 3
		) );
	}

	function woocommerce_loop_columns() {
		return 3; // 3 products per row
	}
	
	function woocommerce_get_image_size_shop_single( $size ) {
		$size['width'] = '800';
		$size['height'] = '800';

		return $size;
	}

	function woocommerce_get_image_size_shop_thumbnail( $size ) {
		$size['width'] = '300';
		$size['height'] = '300';

		return $size;
	}

	function woocommerce_get_image_size_shop_catalog( $size ) {
		$size['width'] = '800';
		$size['height'] = '500';

		return $size;
	}

	/**
	 * This function adjusts the WooCommerce placeholder image.
	 */
	function woocommerce_placeholder_img( $img ) {
		$img = '<div class="post-image post-image-placeholder">
					<div class="dashicons dashicons-images-alt2"></div>
				</div>';

		return $img;
	}

	/**
	 * This function outputs a wrapper element around the WooCommerce product info.
	 */
	function woocommerce_before_shop_loop_item() {
	?>
		<section class="product-info cf">
	<?php
	}

	/**
	 * This function outputs a closing wrapper element for the WooCommerce product info.
	 */
	function woocommerce_after_shop_loop_item() {
	?>
		</section>
	<?php
	}

	/**
	 * This function updates the Top Navigation WooCommerce cart link contents when an item
	 * is added via AJAX.
	 */
	function woocommerce_add_to_cart_fragments( $fragments ) {
		global $woocommerce;

		// Add our fragment
		$fragments['li.menu-item-type-woocommerce-cart'] = $this->wp_nav_menu_items( '', new stdClass(), true );

		return $fragments;
	}
}

function Simple_Shop_Instance() {
	return Simple_Shop::instance();
}

// Starts Simple_Shop
Simple_Shop_Instance();
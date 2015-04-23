<?php
/**
 * This class manages all Customizer functionality with our Simple Shop theme.
 */
class Simple_Shop_Customizer {
	/**
	 * @var string
	 */
	public $version = '1.0.9';

	/**
	 * @var string, Transient name
	 */
	public $transient_name = 'simple_shop_customizer_';

	/**
	 * @var array, Transient data
	 */
	public $transient_data = array();


	private static $instance; // Keep track of the instance

	/**
	 * Function used to create instance of class.
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) )
			self::$instance = new self();

		return self::$instance;
	}


	/*
	 * This function sets up all of the actions and filters on instance
	 */
	function __construct() {
		// Includes
		$this->includes();

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 9999 ); // After Setup Theme (late; load assets based on theme support)

		// Customizer
		add_action( 'customize_register', array( $this, 'customize_register' ), 25 ); // Add settings/sections/controls to Customizer
		add_action( 'customize_controls_print_styles', array( $this, 'customize_controls_print_styles' ), 20 ); // Customizer Styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_enqueue_scripts' ), 20 );
		add_action( 'customize_save_after', array( $this, 'reset_transient' ) ); // Customize Save (reset transients)

		// Color Scheme
		add_filter( 'theme_mod_primary_color', array( $this, 'theme_mod_primary_color' ) ); // Set the default primary color

		// Front End
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {
		// All
		include_once( 'class-simple-shop-customizer-theme-helper.php' ); // Customizer Theme Helper Class

		// Admin Only
		if ( is_admin() ) { }

		// Front-End Only
		if ( ! is_admin() ) { }
	}


	/************************************************************************************
	 *    Functions to correspond with actions above (attempting to keep same order)    *
	 ************************************************************************************/

	/**
	 * This function runs after the theme has been setup and determines which assets to load based on theme support.
	 */
	function after_setup_theme() {
		// Load required assets
		$this->includes();

		$simple_shop_theme_helper = Simple_Shop_Theme_Helper(); // Grab the Simple_Shop_Theme_Helper instance

		// Setup transient data
		$this->transient_name .= $simple_shop_theme_helper->theme->get_template(); // Append theme name to transient name
		$this->transient_data = $this->get_transient();

		// If the theme has updated, let's update the transient data
		if ( ! isset( $this->transient_data['version'] ) || $this->transient_data['version'] !== $simple_shop_theme_helper->theme->get( 'Version' ) )
			$this->reset_transient();
	}

	/**************
	 * Customizer *
	 **************/

	/**
	 * This function registers various Customizer options for this theme.
	 */
	function customize_register( $wp_customize ) {
		$wp_customize->add_section( 'simple_shop_us', array(
			'title' => __( 'Upgrade Simple Shop', 'simple-shop' ),
			'priority' => 1
		) );

		$wp_customize->add_setting(
			'simple_shop_us', // IDs can have nested array keys
			array(
				'default' => false,
				'type' => 'simple_shop_us',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_US_Control(
				$wp_customize,
				'simple_shop_us',
				array(
					'content'  => sprintf(
						__( '<strong>Premium support</strong>, more Customizer options, typography adjustments, and more! %s.', 'simple-shop' ),
						sprintf(
							'<a href="%1$s" target="_blank">%2$s</a>',
							esc_url( sds_get_pro_link( 'customizer' ) ),
							__( 'Upgrade to Pro', 'simple-shop' )
						)
					),
					'section' => 'simple_shop_us',
				)
			)
		);

		/**
		 * General Settings
		 */
		if ( $this->version_compare( '4.0' ) ) {
			/*
			 * General Settings Panel
			 */
			$wp_customize->add_panel( 'simple_shop_general_design', array(
				'priority' => 10, // Top
				'title' => __( 'General Settings', 'simple-shop' )
			) );

			/**
			 * Logo/Site Title & Tagline Section
			 */
			$title_tagline_section = $wp_customize->get_section( 'title_tagline' ); // Get Section
			$title_tagline_section->panel = 'simple_shop_general_design'; // Add panel
			$title_tagline_section->priority = 10; // Adjust Priority


			/**
			 * Static Front Page Section
			 */
			$static_front_page_section = $wp_customize->get_section( 'static_front_page' ); // Get Section
			$static_front_page_section->panel = 'simple_shop_general_design'; // Add panel
			$static_front_page_section->priority = 20; // Adjust Priority


			/**
			 * Nav Section
			 */
			$static_front_page_section = $wp_customize->get_section( 'nav' ); // Get Section
			$static_front_page_section->panel = 'simple_shop_general_design'; // Add panel
			$static_front_page_section->priority = 30; // Adjust Priority
		}

		/**
		 * Background Color & Image Panel
		 */
		if ( $this->version_compare( '4.0' ) ) {
			/*
			 * Background Color & Image Panel
			 */
			$wp_customize->add_panel( 'simple_shop_colors_and_background', array(
				'priority' => 20, // After General Settings Section
				'title' => __( 'Colors &amp; Background', 'simple-shop' )
			) );

			/**
			 * Body Background Section
			 */
			$wp_customize->add_section( 'simple_shop_background_body', array(
				'priority' => 10, // Top
				'title' => __( 'Body', 'simple-shop' ),
				'panel' => 'simple_shop_colors_and_background'
			) );

			/**
			 * Background Color
			 */
			$background_color_control = $wp_customize->get_control( 'background_color' ); // Get Control
			$background_color_control->section = 'simple_shop_background_body'; // Adjust Section
			$background_color_control->priority = 10; // Adjust Priority

			/**
			 * Background Image
			 */
			$background_image_control = $wp_customize->get_control( 'background_image' ); // Get Control
			$background_image_control->section = 'simple_shop_background_body'; // Adjust Section
			$background_image_control->priority = 20; // Adjust Priority
			$wp_customize->remove_section( 'background_image' ); // Remove Section

			/**
			 * Background Repeat
			 */
			$background_repeat_control = $wp_customize->get_control( 'background_repeat' ); // Get Control
			$background_repeat_control->section = 'simple_shop_background_body'; // Adjust Section
			$background_repeat_control->priority = 30; // Adjust Priority

			/**
			 * Background Position X
			 */
			$background_position_x_control = $wp_customize->get_control( 'background_position_x' ); // Get Control
			$background_position_x_control->section = 'simple_shop_background_body'; // Adjust Section
			$background_position_x_control->priority = 40; // Adjust Priority

			/**
			 * Background Attachment
			 */
			$background_attachment_control = $wp_customize->get_control( 'background_attachment' ); // Get Control
			$background_attachment_control->section = 'simple_shop_background_body'; // Adjust Section
			$background_attachment_control->priority = 50; // Adjust Priority
		}


		/**
		 * Colors Section
		 */
		$colors_section = $wp_customize->get_section( 'colors' ); // Get Section
		$colors_section->title = __( 'Primary Theme Color', 'simple-shop' ); // Adjust Title
		$colors_section->panel = 'simple_shop_colors_and_background'; // Adjust Panel
		$colors_section->priority = 10; // Adjust Priority (Top)


		/**
		 * Primary Theme Color
		 */

		// Setting
		$wp_customize->add_setting(
			'primary_color',
			array(
				'default' => apply_filters( 'theme_mod_primary_color', '' ),
				'sanitize_callback' => 'sanitize_hex_color',
				'sanitize_js_callback' => 'maybe_hash_hex_color'
			)
		);

		// Control
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'primary_color',
				array(
					'label' => __( 'Primary Theme Color', 'simple-shop' ),
					'section' => 'colors',
					'settings' => 'primary_color',
					'priority' => 10
				)
			)
		);

		/*
		 * Content Color (remove; registered in SDS Core)
		 */
		$wp_customize->remove_control( 'content_color' );

		// TODO: below 4.0 support
	}

	/**
	 * This function is run when the Theme Customizer is printing styles.
	 */
	function customize_controls_print_styles() {
	?>
		<style type="text/css">
			#accordion-section-simple_shop_us .accordion-section-title,
			#customize-theme-controls #accordion-section-simple_shop_us .accordion-section-title:focus,
			#customize-theme-controls #accordion-section-simple_shop_us .accordion-section-title:hover,
			#customize-theme-controls #accordion-section-simple_shop_us .control-section.open .accordion-section-title,
			#customize-theme-controls #accordion-section-simple_shop_us:hover .accordion-section-title,
			#accordion-section-simple_shop_us .accordion-section-title:active {
				background: #444;
				color: #fff;
			}

			#accordion-section-simple_shop_us .accordion-section-title:after,
			#customize-theme-controls #accordion-section-simple_shop_us .accordion-section-title:focus::after,
			#customize-theme-controls #accordion-section-simple_shop_us .accordion-section-title:hover::after,
			#customize-theme-controls #accordion-section-simple_shop_us.open .accordion-section-title::after,
			#customize-theme-controls #accordion-section-simple_shop_us:hover .accordion-section-title::after {
				color: #fff;
			}
		</style>
	<?php
	}

	/**
	 * This function enqueues scripts and styles on the Customizer.
	 */
	function customize_controls_enqueue_scripts() {
		// Simple Shop Customizer CSS
		wp_enqueue_style( 'simple-shop-customizer', get_template_directory_uri() . '/customizer/css/simple-shop-customizer.css', array( 'sds-theme-options' ) );
	}

	/**
	 * This function sets the default primary color in the Customizer.
	 */
	function theme_mod_primary_color( $color = false ) {
		// Return the current color if set
		if ( $color )
			return $color;

		// Return the default
		return '#1fb25a';
	}

	/**
	 * This function returns a CSS <style> block for Customizer theme mods.
	 */
	// TODO: Add filters
	function get_customizer_css() {
		// Check transient first (not in the Customizer)
		if ( ! $this->is_customize_preview() && ! empty( $this->transient_data ) && isset( $this->transient_data['customizer_css' ] ) )
			return $this->transient_data['customizer_css'];
		// Otherwise return data
		else {
			$sds_theme_options_instance = SDS_Theme_Options_Instance();

			// Open <style>
			$r = '<style type="text/css" id="' . $sds_theme_options_instance->get_parent_theme()->get_template() . '-customizer">';

			// If we have a body background color or image selected by the user
			if ( ! ( get_theme_mod( 'background_color' ) || get_background_image() ) )
				if ( ( $background_css = $this->get_background_image_css() ) ) {
					$r .= '/* Body Background Image & Color */' . "\n";
					$r .= 'body.custom-background {' . "\n";
						$r .= $background_css . "\n";
					$r .= '}' . "\n\n";
				}

			// If we have a primary color selected by the user
			if ( ( $theme_mod_primary_color = $this->get_theme_mod( 'primary_color', $this->theme_mod_primary_color() ) ) ) {
				$theme_mod_primary_color = simple_shop_sanitize_hex_color( $theme_mod_primary_color );

				$r .= '/* Primary Color */' . "\n";
				$r .= 'a,' . "\n";
				$r .= 'nav.primary-nav-container ul:first-of-type li a:hover,' . "\n";
				$r .= '.block-3:hover .product-info h2, .block-3:hover .product-info p, .block-2:hover .calltoaction h2, .block-2:hover .post-info h2, .block-3:hover .post-info h2, .block-3:hover .post-info h2 a,' . "\n";
				$r .= '#front-page-sidebar .front-page-sidebar:hover a, .simple-shop-calltoaction .widget-content:hover p, #front-page-sidebar .front-page-sidebar.woocommerce ul.product_list_widget li a:hover, #front-page-sidebar .simple-shop-recent-posts > ul > li.has-image-placeholder:hover .post-image.post-image-placeholder .dashicons, #front-page-sidebar .simple-shop-recent-posts > ul > li:hover .post-info h2,' . "\n";
				$r .= '.full-post-container a, .post-container a,' . "\n";
				$r .= '.has-image-placeholder:hover .post-image a,' . "\n";
				$r .= '.sidebar a,' . "\n";
				$r .= 'div.summary section.product-info p.amount, button.single_add_to_cart_button:hover,' . "\n";
				$r .= 'footer#footer a, .woocommerce ul.products li a:hover,' . "\n";
				$r .= '.woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a, .woocommerce .star-rating span, .woocommerce-page .star-rating span, .woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price,' . "\n";
				$r .= '.woocommerce ul.products li:hover .post-image-placeholder .dashicons, .woocommerce li.product:hover h3, .woocommerce #content .product:hover h3, .woocommerce-page li.product:hover h3, .woocommerce-page #content .product:hover h3 {' . "\n";
					$r .= 'color: ' . $theme_mod_primary_color . ';' . "\n";
				$r .= '}' . "\n\n";

				$r .= '.more-link, .post-edit-link, input[type=submit], .post-container a.post-edit-link {' . "\n";
					$r .= 'background-color: ' . $theme_mod_primary_color . ';' . "\n";
					$r .= 'border-color: ' . $theme_mod_primary_color . ';' . "\n";
				$r .= '}' . "\n\n";

				$r .= 'nav.top-nav ul li:hover, nav.top-nav ul:first-child li a:hover, nav.primary-nav-container ul:first-of-type > li ul, .pagination ul li a:hover, article.widget-fullbody ul li a:hover, section.widget #searchform input.submit,' . "\n";
				$r .= 'aside.sidebar section.widget form.register input[type=submit], .widget .social-media-icons a, footer#footer .widget .social-media-icons a, #respond input[type="submit"], ul.newsletter-form li input[type=submit]:hover, .reply a:hover {' . "\n";
					$r .= 'background-color: ' . $theme_mod_primary_color . ';' . "\n";
				$r .= '}' . "\n\n";

				$r .= '.mc-gravity .gform_heading, .mc_gravity .gform_heading, .mc-newsletter .gform_heading, .mc_newsletter .gform_heading,' . "\n";
				$r .= '.mc-gravity_wrapper .gform_heading, .mc_gravity_wrapper .gform_heading, .mc-newsletter_wrapper .gform_heading, .mc_newsletter_wrapper .gform_heading,' . "\n";
				$r .= '.mc-gravity .gform_footer input.button, .mc_gravity .gform_footer input.button, .mc-newsletter .gform_footer input.button, .mc_newsletter .gform_footer input.button,' . "\n";
				$r .= '.mc-gravity_wrapper .gform_footer input.button, .mc_gravity_wrapper .gform_footer input.button, .mc-gravity-confirmation, .mc_gravity-confirmation, .mc-newsletter-confirmation, .mc_newsletter-confirmation {' . "\n";
					$r .= 'background: ' . $theme_mod_primary_color . ';' . "\n";
				$r .= '}' . "\n\n";

				$r .= '.woocommerce .product .add_to_cart_button, .woocommerce .cart input.button.checkout-button, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order, .woocommerce #content .product .add_to_cart_button, .woocommerce-page .product .add_to_cart_button, .woocommerce-page #content .product .add_to_cart_button,' . "\n";
				$r .= '.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,' . "\n";
				$r .= '.woocommerce .product .add_to_cart_button, .woocommerce #content .product .add_to_cart_button, .woocommerce-page .product .add_to_cart_button, .woocommerce-page #content .product .add_to_cart_button, .woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,' . "\n";
				$r .= '.woocommerce ul.products li a.button, .woocommerce ul.products li a.button:hover, .woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover {' . "\n";
					$r .= 'background-color: ' . $theme_mod_primary_color . ' !important;' . "\n";
				$r .= '}' . "\n\n";

				$r .= '#respond .form-allowed-tags {' . "\n";
					$r .= 'border-color: ' . $theme_mod_primary_color . ';' . "\n";
				$r .= '}' . "\n\n";
			}

			// Close </style>
			$r .= '</style>';

			return $r;
		}
	}

	/**
	 * This function adjusts the body classes based on theme mods.
	 */
	function body_class( $classes ) {
		// If we don't have a background color or image specified by the user, check our method
		if ( ! ( get_theme_mod( 'background_color' ) || get_background_image() ) )
			$classes['simple-shop-custom-background'] = ( $this->get_background_image_css() ) ? 'custom-background' : false;

		return $classes;
	}

	/**
	 * This function outputs CSS for Customizer settings.
	 */
	function wp_head() {
		// Get Customizer CSS
		echo $this->get_customizer_css();
	}


	/**********************
	 * Internal Functions *
	 **********************/

	/**
	 * This function returns a boolean result comparing WordPress versions.
	 *
	 * @return Boolean
	 */
	public function version_compare( $version, $operator = '>=' ) {
		global $wp_version;

		return version_compare( $wp_version, $version, $operator );
	}

	/**
	 * This function returns a theme mod but first checks to see if it is the default, and if so
	 * no value is returned. This is to prevent unnecessary CSS output in wp_head().
	 */
	function get_theme_mod( $theme_mod_name, $default ) {
		$theme_mod = get_theme_mod( $theme_mod_name );

		// Check this theme mod against the default
		if ( $theme_mod === $default )
			$theme_mod = false;

		return $theme_mod;
	}

	/**
	 * This function returns background image CSS properties based on the theme mod parameter.
	 *
	 * Copyright: WordPress Core (3.0), http://wordpress.org/
	 *
	 * We've used WordPress' function as a base and modified it to suit our needs.
	 */
	function get_background_image_css() {
		// $background is the saved custom image, or the default image.
		$background = set_url_scheme( get_background_image() );

		// $color is the saved custom color.
		// A default has to be specified in style.css. It will not be printed here.
		$color = '#' . sanitize_hex_color_no_hash( get_background_color() );

		//if ( $color === get_theme_support( 'custom-background', 'default-color' ) )
		//	$color = false;

		if ( ! $background && ! $color )
			return false;

		$style = $color ? "background-color: #$color;" : '';

		if ( $background ) {
			$background = esc_url( $background );
			$image = " background-image: url('$background');";

			$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
			if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
				$repeat = 'repeat';
			$repeat = " background-repeat: $repeat;";

			$position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
			if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
				$position = 'left';
			$position = " background-position: top $position;";

			$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
			if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
				$attachment = 'scroll';
			$attachment = " background-attachment: $attachment;";

			$style .= $image . $repeat . $position . $attachment;
		}

		return $style;
	}

	/**
	 * This function resets transient data to ensure front-end matches Customizer preview.
	 */
	function reset_transient() {
		// Reset transient data on this class
		$this->transient_data = array();

		// Delete the transient data
		$this->delete_transient();

		// Set the transient data
		$this->set_transient();
	}

	/**
	 * This function gets our transient data. Additionally it calls the set_transient()
	 * method on this class to set and return transient data if the transient data doesn't
	 * currently exist.
	 */
	function get_transient() {
		// Check for transient data first
		if ( ! $transient_data = get_transient( $this->transient_name ) )
			// Create and return the transient data if it doesn't exist
			$transient_data = $this->set_transient();

		return $transient_data;
	}

	/**
	 * This function stores data in our transient and returns the data.
	 */
	function set_transient() {
		$simple_shop_theme_helper = Simple_Shop_Theme_Helper(); // Grab the Simple_Shop_Theme_Helper instance

		$data = array(); // Default

		// Always add the Customizer CSS
		$data['customizer_css'] = $this->get_customizer_css();

		// Always add the theme's version
		$data['version'] = $simple_shop_theme_helper->theme->get( 'Version' );

		// Set the transient
		set_transient( $this->transient_name, $data );

		return $data;
	}

	/**
	 * This function deletes our transient data.
	 */
	function delete_transient() {
		// Delete the transient
		delete_transient( $this->transient_name );
	}

	/**
	 * This function determines if the site is currently being previewed in the Customizer.
	 */
	public function is_customize_preview() {
		$simple_shop_customizer = Simple_Shop_Customizer_Instance();
		$is_wp_4 = $simple_shop_customizer->version_compare( '4.0' );

		// Less than 4.0
		if ( ! $is_wp_4 ) {
			global $wp_customize;

			return is_a( $wp_customize, 'WP_Customize_Manager' ) && $wp_customize->is_preview();
		}
		// 4.0 or greater
		else
			return is_customize_preview();
	}
}


function Simple_Shop_Customizer_Instance() {
	return Simple_Shop_Customizer::instance();
}

// Starts Simple Shop
Simple_Shop_Customizer_Instance();
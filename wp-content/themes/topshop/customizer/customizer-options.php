<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library Demo
 */

function customizer_library_topshop_options() {

	// Theme defaults
	$primary_color = '#29a6e5';
	$secondary_color = '#266ee4';
    
    $body_font_color = '#4F4F4F';
    $heading_font_color = '#5E5E5E';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo
	$section = 'topshop-favicon';
    
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Favicon', 'topshop' ),
		'priority' => '10',
		'description' => __( 'Add a favicon to your website', 'topshop' )
	);
    
	$options['topshop-header-favicon'] = array(
		'id' => 'topshop-header-favicon',
		'label'   => __( 'Favicon', 'topshop' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);
    
    
    // Layout Settings
    $section = 'topshop-layout';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Layout Options', 'topshop' ),
        'priority' => '30'
    );
    
    // Upsell Button One
    $options['topshop-upsell-one'] = array(
        'id' => 'topshop-upsell-one',
        'label'   => __( 'Site Layout', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    // Upsell Button Two
    $options['topshop-upsell-two'] = array(
        'id' => 'topshop-upsell-two',
        'label'   => __( 'Header Layout', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $options['topshop-header-search'] = array(
        'id' => 'topshop-header-search',
        'label'   => __( 'Show Search', 'topshop' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Enable to a slogan for your site. This uses the site Tagline', 'topshop' ),
        'default' => 1,
    );
    $options['topshop-sticky-header'] = array(
        'id' => 'topshop-sticky-header',
        'label'   => __( 'Sticky Header', 'topshop' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'Select this box to make the main navigation sticky', 'topshop' ),
        'default' => 0,
    );
    $options['topshop-show-header-top-bar'] = array(
        'id' => 'topshop-show-header-top-bar',
        'label'   => __( 'Show Top Bar', 'topshop' ),
        'section' => $section,
        'type'    => 'checkbox',
        'description' => __( 'This will show/hide the top bar in the header<br /><a href="http://support.kairaweb.com/knowledgebase/top-bar-not-showing/" target="_blank">Not working? See here</a><br /><br /><a href="http://support.kairaweb.com/knowledgebase/topshop-hooks-for-developers/" target="_blank">TopShop Premium has hooks</a> integrated for developers to hook on to.', 'topshop' ),
        'default' => 1,
    );
    
    
    // Blog Settings
    $section = 'topshop-slider';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Slider Options', 'topshop' ),
        'priority' => '35'
    );
    
    $choices = array(
        'topshop-slider-default' => 'Default Slider',
        'topshop-meta-slider' => 'Meta Slider',
        'topshop-no-slider' => 'None'
    );
    $options['topshop-slider-type'] = array(
        'id' => 'topshop-slider-type',
        'label'   => __( 'Choose a Slider', 'topshop' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $choices,
        'default' => 'topshop-slider-default'
    );
    $options['topshop-slider-cats'] = array(
        'id' => 'topshop-slider-cats',
        'label'   => __( 'Slider Categories', 'topshop' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you want to display in the slider. Eg: "13,17,19" (no spaces and only comma\'s)<br /><a href="http://support.kairaweb.com/knowledgebase/setup-the-topshop-default-slider/" target="_blank"><b>Follow instructions here</b></a>', 'topshop' )
    );
    $options['topshop-meta-slider-shortcode'] = array(
        'id' => 'topshop-meta-slider-shortcode',
        'label'   => __( 'Slider Shortcode', 'topshop' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the shortcode give by meta slider.', 'topshop' )
    );
    
    // Upsell Button Slider
    $options['topshop-upsell-two-one'] = array(
        'id' => 'topshop-upsell-two-one',
        'label'   => __( 'Extra Slider Settings', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );


	// Colors
	$section = 'topshop-styling';
    $font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Styling Options', 'topshop' ),
		'priority' => '38'
	);

	$options['topshop-main-color'] = array(
		'id' => 'topshop-main-color',
		'label'   => __( 'Main Color', 'topshop' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);
	$options['topshop-main-color-hover'] = array(
		'id' => 'topshop-main-color-hover',
		'label'   => __( 'Secondary Color', 'topshop' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);
    
    $options['topshop-body-font'] = array(
        'id' => 'topshop-body-font',
        'label'   => __( 'Body Font', 'topshop' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Open Sans'
    );
    $options['topshop-body-font-color'] = array(
        'id' => 'topshop-body-font-color',
        'label'   => __( 'Body Font Color', 'topshop' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $body_font_color,
    );
    $options['topshop-heading-font'] = array(
        'id' => 'topshop-heading-font',
        'label'   => __( 'Headings Font', 'topshop' ),
        'section' => $section,
        'type'    => 'select',
        'choices' => $font_choices,
        'default' => 'Raleway'
    );
    $options['topshop-heading-font-color'] = array(
        'id' => 'topshop-heading-font-color',
        'label'   => __( 'Heading Font Color', 'topshop' ),
        'section' => $section,
        'type'    => 'color',
        'default' => $heading_font_color,
    );
    
    // Upsell Button Styling
    $options['topshop-upsell-two-two'] = array(
        'id' => 'topshop-upsell-two-two',
        'label'   => __( 'Extra Styling options', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    $options['topshop-custom-css'] = array(
        'id' => 'topshop-custom-css',
        'label'   => __( 'Custom CSS', 'topshop' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( '', 'topshop'),
        'description' => __( 'Add custom CSS to your theme', 'topshop' )
    );
    
    
    // Blog Settings
    $section = 'topshop-blog';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Blog Options', 'topshop' ),
        'priority' => '50'
    );
    
    // Upsell Button Three
    $options['topshop-upsell-three'] = array(
        'id' => 'topshop-upsell-three',
        'label'   => __( 'Blog Post Layout', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['topshop-blog-title'] = array(
        'id' => 'topshop-blog-title',
        'label'   => __( 'Blog Page Title', 'topshop' ),
        'section' => $section,
        'type'    => 'text',
        'default' => 'Blog'
    );
    $options['topshop-blog-cats'] = array(
        'id' => 'topshop-blog-cats',
        'label'   => __( 'Exclude Blog Categories', 'topshop' ),
        'section' => $section,
        'type'    => 'text',
        'description' => __( 'Enter the ID\'s of the post categories you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />Eg: "-13, -17, -19"<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in those categories.', 'topshop' )
    );
    
    
    // Social Settings
    $section = 'topshop-social';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Social Links', 'topshop' ),
        'priority' => '80'
    );
    
    // Upsell Button Four
    $options['topshop-upsell-four'] = array(
        'id' => 'topshop-upsell-four',
        'label'   => __( 'Add Social Links', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    
    
    // Site Text Settings
    $section = 'topshop-website';

    $sections[] = array(
        'id' => $section,
        'title' => __( 'Website Text', 'topshop' ),
        'priority' => '50'
    );
    
    $options['topshop-header-info-text'] = array(
        'id' => 'topshop-header-info-text',
        'label'   => __( 'Header Info Text', 'topshop' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Call Us: 082 444 BOOM', 'topshop'),
        'description' => __( 'This is the text in the header', 'topshop' )
    );
    // Upsell Button Five
    $options['topshop-upsell-five'] = array(
        'id' => 'topshop-upsell-five',
        'label'   => __( 'Site Copy Text', 'topshop' ),
        'section' => $section,
        'type'    => 'upsell',
    );
    $options['topshop-website-error-head'] = array(
        'id' => 'topshop-website-error-head',
        'label'   => __( '404 Error Page Heading', 'topshop' ),
        'section' => $section,
        'type'    => 'text',
        'default' => __( 'Oops! <span>404</span>', 'topshop'),
        'description' => __( 'Enter the heading for the 404 Error page', 'topshop' )
    );
    $options['topshop-website-error-msg'] = array(
        'id' => 'topshop-website-error-msg',
        'label'   => __( 'Error 404 Message', 'topshop' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'It looks like that page does not exist. <br />Return home or try a search', 'topshop'),
        'description' => __( 'Enter the default text on the 404 error page (Page not found)', 'topshop' )
    );
    $options['topshop-website-nosearch-msg'] = array(
        'id' => 'topshop-website-nosearch-msg',
        'label'   => __( 'No Search Results', 'topshop' ),
        'section' => $section,
        'type'    => 'textarea',
        'default' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'topshop'),
        'description' => __( 'Enter the default text for when no search results are found', 'topshop' )
    );

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_topshop_options' );

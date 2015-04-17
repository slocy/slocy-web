<?php
/**
 * Kaira Settings theme class
 * 
 */
class Kaira_theme_settings {
	
	private $sections;
	private $checkboxes;
	private $settings;
	
	/**
	 * The Construct function
	 */
	public function __construct() {
		// To keep track of the checkbox options for the validate_kaira_settings function.
		$this->checkboxes = array();
		$this->settings = array();
		$this->get_kaira_option();
		
		$this->sections['general']   = __( 'General Settings', 'albar' );
        $this->sections['slider']   = __( 'Slider Settings', 'albar' );
		$this->sections['styling']   = __( 'Styling Settings', 'albar' );
        $this->sections['blog']   = __( 'Blog Settings', 'albar' );
        $this->sections['social']   = __( 'Social Links', 'albar' );
        $this->sections['website']   = __( 'Website Text', 'albar' );
        
		$this->sections['premium']     = __( 'Kaira', 'albar' );
		
		add_action( 'admin_menu', array( &$this, 'kaira_add_pages' ) );
        
		add_action( 'admin_init', array( &$this, 'kaira_register_settings' ) );
		
	}
    
    /**
     * Set defaults by the std value without saving to the db
     */
    public function kaira_get_options_with_defaults() {

        $options_set_before = get_option( 'kaira_theme_options');

        // defaults
        $dafaults_array = array();
        foreach ($this->settings as $settings_key => $settings_array) {
            if( isset($settings_array['std']) ){
                if( !$options_set_before ){
                    $dafaults_array[ $settings_key ] = $settings_array['std'];
                }
            }
        }

        // Options API
        $options = wp_parse_args(
            get_option( 'kaira_theme_options', array() ),
            $dafaults_array
        );

        return $options;

    }
	
	/**
	 * Add an options page
	 */
	public function kaira_add_pages() {
		$admin_page = add_theme_page( __( 'ALBAR Settings', 'albar' ), __( 'ALBAR Settings', 'albar' ), 'manage_options', 'kaira-theme-options', array( &$this, 'kaira_display_page' ) );
		
		add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'load_kaira_scripts' ) );
		add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'load_kaira_styles' ) );
		
	}
	
	/**
	 * Create settings field
	 */
	public function kaira_create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'kra-default-field',
			'title'   => __( 'Kaira Setting', 'albar' ),
			'desc'    => __( 'This is a default description.', 'albar' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		
		add_settings_field( $id, $title, array( $this, 'kaira_display_setting' ), 'kaira-theme-options', $section, $field_args );
	}
	
	/**
	 * Display options page
	 */
	public function kaira_display_page() {
		
		echo '<div class="wrap kaira-theme-options-wrap">
            	<div class="icon32" id="icon-options-general"></div>
            	<h2>' . __( 'Albar Theme Settings', 'albar' ) . '</h2>
                <div class="kaira-recommended-plugins">' . __( 'Install <a href="'. admin_url('plugin-install.php?tab=favorites&user=kaira') . '" target="_blank">recommended plugins</a> to make your website development easier', 'albar' ) . '</div>';
            		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
            			echo '<div class="updated fade"><p>' . __( 'Theme options updated.', 'albar' ) . '</p></div>';
            		
            		echo '<form action="options.php" method="post">';
            	
            		settings_fields( 'kaira_theme_options' );
            		echo '<div class="ui-tabs">
            			<ul class="ui-tabs-nav">';
            		
                    $tab_count = 1;
            		foreach ( $this->sections as $section_slug => $section ) {
            			echo '<li><a href="#tab-' . $tab_count . '">' . $section . '</a></li>';
                        $tab_count++;
                    }
            		
            		echo '</ul>';
            		do_settings_sections( $_GET['page'] );
            		
            		echo '</div>
            		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save Changes', 'albar' ) . '" /></p>
            	</form>';
    	echo '</div>';
	}
	
	/**
	 * Description for section
	 */
	public function kaira_display_section() {
		// code
	}
	
	/**
	 * Description for the Premium Tab section
	 */
	public function display_kaira_premium_section() {
		// This displays the upsell page located in 'settings/tpl/'
		locate_template( 'settings/tpl/upsell-page.php', true, false );
	}
	
	/**
	 * HTML output for text field
	 */
	public function kaira_display_setting( $args = array() ) {
		
        extract( $args );
		
		$options = $this->kaira_get_options_with_defaults();
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
        
        if ( ! isset( $options[$id] ) )
            $options[$id] = '';
		
		switch ( $type ) {
			
			case 'heading':
                echo '</td></tr><tr valign="top"><td colspan="2" class="kaira-heading-td"><h4>' . esc_html( $desc ) . '</h4>';
                break;
            
            case 'checkbox':
                echo '<input class="checkbox' . esc_attr( $field_class ) . '" type="checkbox" id="' . esc_attr( $id ) . '" name="kaira_theme_options[' . esc_attr( $id ) . ']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label class="option-description" for="' . esc_attr( $id ) . '">' . wp_kses_post( $desc ) . '</label>';
                break;
            
            case 'select':
                echo '<select class="kaira-select' . esc_attr( $field_class ) . '" name="kaira_theme_options[' . esc_attr( $id ) . ']">';
                
                foreach ( $choices as $value => $label )
                    echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . esc_attr( $label ) . '</option>';
                
                echo '</select>';
                
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span>';
                
                break;
            
            case 'radio':
                $i = 0;
                foreach ( $choices as $value => $label ) {
                    echo '<div class="radio-option"><input class="radio' . esc_attr( $field_class ) . '" type="radio" name="kaira_theme_options[' . esc_attr( $id ) . ']" id="' . esc_attr( $id ) . esc_attr( $i ) . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label class="option-description" for="' . esc_attr( $id ) . esc_attr( $i ) . '">' . esc_attr( $label ) . '</label></div>';
                    $i++;
                }
                
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span>';
                
                break;
            
            case 'textarea':
                echo '<textarea class="kaira-textarea ' . esc_attr( $field_class ) . '" id="' . esc_attr( $id ) . '" name="kaira_theme_options[' . esc_attr( $id ) . ']" rows="5" cols="30">' . esc_textarea( $options[$id] ) . '</textarea>';
                
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span>';
                
                break;
                
            case 'number':
                echo '<input type="number" id="' . esc_attr( $id ) . '" class="kaira-number" min="" max="" step="any" name="kaira_theme_options[' . esc_attr( $id ) . ']" value="' . esc_attr( $options[$id] ) . '" placeholder="">';
                
                break;
                
            case 'media':
                echo '<input id="' . esc_attr( $id ) . '" class="kaira-media-upload" name="kaira_theme_options[' . esc_attr( $id ) . ']" type="text" value="' . esc_url_raw( $options[$id] ) . '" />
                      <input id="' . esc_attr( $id ) . '_button" class="media_upload_button" name="' . esc_attr( $id ) . '_button" type="text" value="Upload" />';
                      
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span></label>';
                if ( $options[$id] != '' )
                    echo '<img src="' . esc_url( $options[$id] ) . '" class="media_upload_img_preview" />';
            
                break;
                
            case 'url':
                echo '<input class="kaira-url' . esc_attr( $field_class ) . '" type="text" id="' . esc_attr( $id ) . '" name="kaira_theme_options[' . esc_attr( $id ) . ']" value="' . esc_url_raw( $options[$id] ) . '" />';
                
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span>';
                
                break;
                
            case 'color':
                echo '<div class="color-picker-wrapper" id="' . esc_attr( $id ) . '">
                        <span class="color-indicator" style="background-color: ' . esc_attr( $options[$id] ) . '"></span>
                        <input type="text" name="kaira_theme_options[' . esc_attr( $id ) . ']" class="color_picker" value="' . esc_attr( $options[$id] ) . '" data-default-color="' . esc_attr( $options[$id] ) . '" />
                      </div>';
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span></label>';
            
                break;
                
            case 'upsell':
                echo '<a href="' . esc_url( $desc ) . '" class="kaira-upsell-btn" target="_blank">Upgrade to Albar Premium</a>';
                echo '<br /><span class="description">' . __( 'Upgrade to premium only <b>$15</b>', 'albar' ) . '</span></label>';
                break;
						
			case 'text':
            default:
                echo '<input class="kaira-text' . esc_attr( $field_class ) . '" type="text" id="' . esc_attr( $id ) . '" name="kaira_theme_options[' . esc_attr( $id ) . ']" value="' . esc_attr( $options[$id] ) . '" />';
                
                if ( $desc != '' )
                    echo '<br /><span class="description">' . wp_kses_post( $desc ) . '</span>';
                
                break;
		 	
		}
		
	}
	
	/**
	 * Settings and defaults
	 */
	public function get_kaira_option() {
		
		/* General Settings
		===========================================*/
		$this->settings['kra-website-layout'] = array(
            'section' => 'general',
            'title'   => __( 'Website Layout', 'albar' ),
            'desc'    => __( 'Select if you\'d like the layout to be Full Width or Boxed', 'albar' ),
            'type'    => 'select',
            'std'     => 'site-layout-boxed',
            'choices' => array(
                'site-layout-full-width' => 'Full Width Layout',
                'site-layout-boxed' => 'Boxed Layout'
            )
        );
		$this->settings['kra-favicon'] = array(
			'title'   => __( 'Favicon', 'albar' ),
			'desc'    => __( 'Upload a favicon to your website, this needs to be 16 pixels by 16 pixels', 'albar' ),
			'std'     => '',
			'type'    => 'media',
			'section' => 'general'
		);
        
        $this->settings['kra-heading-one'] = array(
            'section' => 'general',
            'title'   => '', // Not used for headings.
            'desc'    => 'Header Settings',
            'type'    => 'heading'
        );
        $this->settings['kra-heading-upsell-one'] = array(
            'section' => 'general',
            'title'   => __( 'Header Layout', 'albar' ),
            'desc'    => __( 'http://sllwi.re/p/Eu', 'albar' ),
            'type'    => 'upsell',
            'std'     => ''
        );
        $this->settings['kra-header-search'] = array(
            'section' => 'general',
            'title'   => __( 'Header Search', 'albar' ),
            'desc'    => __( 'Select this to show the search in the header', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 1 // Set to 1 to be checked by default
        );
        $this->settings['kra-heading-upsell-two'] = array(
            'section' => 'general',
            'title'   => __( 'Sticky Header', 'albar' ),
            'desc'    => __( 'http://sllwi.re/p/Eu', 'albar' ),
            'type'    => 'upsell',
            'std'     => ''
        );
        
        
        /* Homepage Slider Settings
        ===========================================*/
        $this->settings['kra-enable-home-slider'] = array(
            'section' => 'slider',
            'title'   => __( 'Enable Slider', 'albar' ),
            'desc'    => __( 'Click to enable the default homepage slider<br /><br />See <a href="http://demo.kairaweb.com/albar/installing-premium/albar-default-slider/" target="_blank">instructions here</a> on setting up the default slider', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 1 // Set to 1 to be checked by default
        );
        
        $this->settings['kra-heading-two'] = array(
            'section' => 'slider',
            'title'   => '', // Not used for headings.
            'desc'    => 'Slider Options',
            'type'    => 'heading'
        );
        $this->settings['kra-slider-categories'] = array(
            'section' => 'slider',
            'title'   => __( 'Slider Categories', 'albar' ),
            'desc'    => __( 'Enter the ID of the <a href="'. admin_url('edit-tags.php?taxonomy=category') . '" target="_blank">post categories</a> you\'d like to display in the Homepage Slider, separated by a comma (,) -> Eg: "13, 17, 19"', 'albar' ),
            'type'    => 'text',
            'std'     => ''
        );
        $this->settings['kra-heading-upsell-three'] = array(
            'section' => 'slider',
            'title'   => __( 'Slider Transitions', 'albar' ),
            'desc'    => __( 'http://sllwi.re/p/Eu', 'albar' ),
            'type'    => 'upsell',
            'std'     => ''
        );
        $this->settings['kra-circular-slider'] = array(
            'section' => 'slider',
            'title'   => __( 'Circular slider', 'albar' ),
            'desc'    => __( 'Select if the slider should be circular', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 1 // Set to 1 to be checked by default
        );
        $this->settings['kra-infinite-slider'] = array(
            'section' => 'slider',
            'title'   => __( 'Infinite slider', 'albar' ),
            'desc'    => __( 'Select if the slider should be infinite', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 1 // Set to 1 to be checked by default
        );
        $this->settings['kra-enable-slider-pagination'] = array(
            'section' => 'slider',
            'title'   => __( 'Show slider Pagination', 'albar' ),
            'desc'    => __( 'Click to display slider pagination', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 1 // Set to 1 to be checked by default
        );
        $this->settings['kra-slider-auto-scroll'] = array(
            'section' => 'slider',
            'title'   => __( 'Scroll the slider automatically', 'albar' ),
            'desc'    => __( 'Click to scroll the slider automatically', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 0 // Set to 1 to be checked by default
        );
        $this->settings['kra-slider-links'] = array(
            'section' => 'slider',
            'title'   => __( 'Enable slider links', 'albar' ),
            'desc'    => __( 'Select if you want the slides to link to their post page<br /><br />See here how to <a href="http://demo.kairaweb.com/albar/installing-premium/removing-the-slider-title/" target="_blank">remove the slider titles</a>', 'albar' ),
            'type'    => 'checkbox',
            'std'     => 0 // Set to 1 to be checked by default
        );
        
        
        /* Styling Settings
        ===========================================*/
        $this->settings['kra-primary-color'] = array(
            'title'   => __( 'Main Color', 'albar' ),
            'desc'    => __( 'This is the color of buttons, etc around the site. Default: #4965A0', 'albar' ),
            'std'     => '#4965A0',
            'type'    => 'color',
            'section' => 'styling'
        );
        $this->settings['kra-primary-color-hover'] = array(
            'title'   => __( 'Main Hover Color', 'albar' ),
            'desc'    => __( 'This is the hover color for buttons, etc around the site. Default: #3e578b', 'albar' ),
            'std'     => '#3e578b',
            'type'    => 'color',
            'section' => 'styling'
        );
        
        $this->settings['kra-heading-three'] = array(
            'section' => 'styling',
            'title'   => '', // Not used for headings.
            'desc'    => 'Website Fonts',
            'type'    => 'heading'
        );
        $this->settings['kra-body-google-font-url'] = array(
            'section' => 'styling',
            'title'   => __( 'Body font URL', 'albar' ),
            'desc'    => __( 'Enter ONLY the fonts URL here. Eg: link href=\'<b><big> //fonts.googleapis.com/css?family=Open+Sans:400italic,400 </big></b>\' rel=\'stylesheet\' type=\'text/css\'', 'albar' ),
            'type'    => 'url',
            'std'     => '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic'
        );
        $this->settings['kra-body-google-font-name'] = array(
            'section' => 'styling',
            'title'   => __( 'Body font name', 'albar' ),
            'desc'    => __( 'Enter the FULL name. Eg:<b><big> font-family: \'Open Sans\', sans-serif; </big></b>', 'albar' ),
            'type'    => 'text',
            'std'     => 'font-family: \'Open Sans\', sans-serif;'
        );
        $this->settings['kra-body-google-font-color'] = array(
            'title'   => __( 'Body font color', 'albar' ),
            'desc'    => __( 'Select a color for the body font. Default: #7B7D80', 'albar' ),
            'std'     => '#7B7D80',
            'type'    => 'color',
            'section' => 'styling'
        );
        $this->settings['kra-heading-google-font-url'] = array(
            'section' => 'styling',
            'title'   => __( 'Heading font URL', 'albar' ),
            'desc'    => __( 'Enter ONLY the fonts URL here. Eg: link href=\'<b><big> //fonts.googleapis.com/css?family=Open+Sans:400italic,400 </big></b>\' rel=\'stylesheet\' type=\'text/css\'', 'albar' ),
            'type'    => 'url',
            'std'     => '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic'
        );
        $this->settings['kra-heading-google-font-name'] = array(
            'section' => 'styling',
            'title'   => __( 'Heading font name', 'albar' ),
            'desc'    => __( 'Enter the FULL name. Eg:<b><big> font-family: \'Roboto\', sans-serif; </big></b>', 'albar' ),
            'type'    => 'text',
            'std'     => 'font-family: \'Roboto\', sans-serif;'
        );
        $this->settings['kra-heading-google-font-color'] = array(
            'title'   => __( 'Heading font color', 'albar' ),
            'desc'    => __( 'Select a color for the body font. Default: #5A5A5A', 'albar' ),
            'std'     => '#5A5A5A',
            'type'    => 'color',
            'section' => 'styling'
        );
        
        $this->settings['kra-heading-four'] = array(
            'section' => 'styling',
            'title'   => '', // Not used for headings.
            'desc'    => 'Custom Styling',
            'type'    => 'heading'
        );
        $this->settings['kra-custom-css'] = array(
            'title'   => __( 'Custom CSS', 'albar' ),
            'desc'    => __( 'Add Custom CSS to add your own styling to the Theme', 'albar' ),
            'std'     => '',
            'type'    => 'textarea',
            'section' => 'styling',
            'class'   => 'code'
        );
        
        
        /* Blog Settings
        ===========================================*/
        $this->settings['kra-heading-upsell-four'] = array(
            'section' => 'blog',
            'title'   => __( 'Blog Layout', 'albar' ),
            'desc'    => __( 'http://sllwi.re/p/Eu', 'albar' ),
            'type'    => 'upsell',
            'std'     => ''
        );
        $this->settings['kra-blog-excl-categories'] = array(
            'section' => 'blog',
            'title'   => __( 'Blog Categories', 'albar' ),
            'desc'    => __( 'Enter the ID of the <a href="'. admin_url('edit-tags.php?taxonomy=category') . '" target="_blank">post categories</a> you\'d like to EXCLUDE from the Blog, enter only the ID\'s with a minus sign (-) before them, separated by a comma (,)<br />If you enter the ID\'s without the minus then it\'ll show ONLY posts in that category.<br />Eg: "-13, -17, -19"', 'albar' ),
            'type'    => 'text',
            'std'     => ''
        );
        $this->settings['kra-blog-title'] = array(
            'section' => 'blog',
            'title'   => __( 'Blog Page Title', 'albar' ),
            'desc'    => __( 'Enter the title you want for the blog page.', 'albar' ),
            'type'    => 'text',
            'std'     => 'Blog'
        );
        $this->settings['kra-blog-ppp'] = array(
            'section' => 'blog',
            'title'   => __( 'Blog Posts Per Page', 'albar' ),
            'desc'    => __( 'Enter the number of posts you\'d like to show per page', 'albar' ),
            'type'    => 'number',
            'std'     => '10'
        );
        
        
        /* Social Links
        ===========================================*/
        $this->settings['kra-social-email'] = array(
            'section' => 'social',
            'title'   => __( 'Email Address', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-skype'] = array(
            'section' => 'social',
            'title'   => __( 'Skype', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-facebook'] = array(
            'section' => 'social',
            'title'   => __( 'Facebook', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-twitter'] = array(
            'section' => 'social',
            'title'   => __( 'Twitter', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-google-plus'] = array(
            'section' => 'social',
            'title'   => __( 'Google Plus', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-youtube'] = array(
            'section' => 'social',
            'title'   => __( 'YouTube', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-instagram'] = array(
            'section' => 'social',
            'title'   => __( 'Instagram', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-pinterest'] = array(
            'section' => 'social',
            'title'   => __( 'Pinterest', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-linkedin'] = array(
            'section' => 'social',
            'title'   => __( 'LinkedIn', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-tumblr'] = array(
            'section' => 'social',
            'title'   => __( 'Tumblr', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        $this->settings['kra-social-flickr'] = array(
            'section' => 'social',
            'title'   => __( 'Flickr', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'url',
            'std'     => ''
        );
        
        
        /* Website Text
        ===========================================*/
        $this->settings['kra-website-txt-address'] = array(
            'section' => 'website',
            'title'   => __( 'Address', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'text',
            'std'     => 'Incolm Place, Cape Town, South Africa'
        );
        $this->settings['kra-website-txt-email'] = array(
            'section' => 'website',
            'title'   => __( 'Email Address', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'text',
            'std'     => 'hello@albar.com'
        );
        $this->settings['kra-website-txt-phone'] = array(
            'section' => 'website',
            'title'   => __( 'Phone Number', 'albar' ),
            'desc'    => __( '', 'albar' ),
            'type'    => 'text',
            'std'     => '+27 82 444 4444'
        );
        
        $this->settings['kra-heading-six'] = array(
            'section' => 'website',
            'title'   => '', // Not used for headings.
            'desc'    => 'Footer',
            'type'    => 'heading'
        );
        $this->settings['kra-heading-upsell-five'] = array(
            'section' => 'website',
            'title'   => __( 'Footer Copy Text', 'albar' ),
            'desc'    => __( 'http://sllwi.re/p/Eu', 'albar' ),
            'type'    => 'upsell',
            'std'     => ''
        );
        $this->settings['kra-heading-seven'] = array(
            'section' => 'website',
            'title'   => '', // Not used for headings.
            'desc'    => '404 Error Page',
            'type'    => 'heading'
        );
        $this->settings['kra-website-error-head'] = array(
            'section' => 'website',
            'title'   => __( '404 Error Page Heading', 'albar' ),
            'desc'    => __( 'Enter the heading for the 404 Error page', 'albar' ),
            'type'    => 'text',
            'std'     => 'Oops! That page can\'t be found.'
        );
        $this->settings['kra-website-error-msg'] = array(
            'title'   => __( 'Error 404 Message', 'albar' ),
            'desc'    => __( 'Enter the default text on the 404 error page (Page not found)', 'albar' ),
            'std'     => 'The page you are looking for can\'t be found. Please select one of the options below.',
            'type'    => 'textarea',
            'section' => 'website',
            'class'   => 'code'
        );
        
        $this->settings['kra-heading-eight'] = array(
            'section' => 'website',
            'title'   => '', // Not used for headings.
            'desc'    => 'Search Results Page',
            'type'    => 'heading'
        );
        $this->settings['kra-website-nosearch-msg'] = array(
            'title'   => __( 'No Search Results', 'albar' ),
            'desc'    => __( 'Enter the default text for when no search results are found', 'albar' ),
            'std'     => 'Sorry, but nothing matched your search terms. Please try again with some different keywords or return to home.',
            'type'    => 'textarea',
            'section' => 'website',
            'class'   => 'code'
        );
		
	}
	
	/**
	* Register settings
	*/
	public function kaira_register_settings() {
		
		register_setting( 'kaira_theme_options', 'kaira_theme_options', array ( &$this, 'validate_kaira_settings' ) );
		
		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'premium' )
				add_settings_section( $slug, $title, array( &$this, 'display_kaira_premium_section' ), 'kaira-theme-options' );
			else
				add_settings_section( $slug, $title, array( &$this, 'kaira_display_section' ), 'kaira-theme-options' );
		}
		
		// $this->get_kaira_option();
		
		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			$this->kaira_create_setting( $setting );
		}
		
	}
	
	/**
	* jQuery Tabs
	*/
	public function load_kaira_scripts() {
        wp_register_script( 'kaira-theme-admin-js', get_stylesheet_directory_uri() . '/settings/js/kaira-admin.js', array( 'jquery', 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch', 'iris', 'wp-color-picker' ), false, 1 );
        wp_enqueue_script( 'kaira-theme-admin-js' );
        wp_print_scripts( 'jquery-ui-tabs' );
        wp_enqueue_media();
	}
	
	/**
	* Styling for the theme options page
	*/
	public function load_kaira_styles() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_register_style( 'kaira-theme-admin-css', get_stylesheet_directory_uri() . '/settings/css/kaira-admin.css' );
        wp_enqueue_style( 'kaira-theme-admin-css' );
	}
	
	/**
	* Validate settings
	*/
	public function validate_kaira_settings( $input ) {
		
		if ( ! isset( $input['reset_theme'] ) ) {
			$options = $this->kaira_get_options_with_defaults();
			
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			
			return $input;
		}
		return false;
		
	}
	
}

$theme_options = new Kaira_theme_settings();

function kaira_theme_option( $option ) {
    if ( ! isset ( $theme_options ) )
        $theme_options = new Kaira_theme_settings();
    
    $options = $theme_options->kaira_get_options_with_defaults();
    if ( isset( $options[$option] ) )
        return $options[$option];
    else
        return false;
} ?>
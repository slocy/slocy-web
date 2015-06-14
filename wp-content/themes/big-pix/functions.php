<?php

// LOAD BIGPIX CORE (if you remove this, the theme will break)
require_once( 'library/bigpix.php' );


function BIGPIX_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'BIGPIX', get_template_directory() . '/library/translation' );

  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'BIGPIX_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'BIGPIX_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'use_default_gallery_style', '__return_false' ); 

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'BIGPIX_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  BIGPIX_theme_support();

  // adding sidebars to WordPress (these are created in functions.php)
  add_action( 'widgets_init', 'BIGPIX_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'BIGPIX_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'BIGPIX_excerpt_more' );

  /************* OEMBED SIZE OPTIONS *************/

  global $content_width;
  if ( ! isset( $content_width ) ) {
  $content_width = 640;
  }

  set_post_thumbnail_size( 600, 600 );

  // Thumbnail sizes
  add_image_size( 'BIGPIX-thumb-600', 600, 150, true );
  add_image_size( 'BIGPIX-thumb-300', 300, 100, true );
  add_image_size( 'BIGPIX-slider-image', 1280, 500, true );
  add_image_size( 'BIGPIX-thumb-image-300by300', 300, 300, true );

} /* end bigpix ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'BIGPIX_ahoy' );


/************* THUMBNAIL SIZE OPTIONS *************/


add_filter( 'image_size_names_choose', 'BIGPIX_custom_image_sizes' );
function BIGPIX_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'BIGPIX-thumb-600' => '600px by 150px',
        'BIGPIX-thumb-300' => '300px by 100px',
        'BIGPIX-slider-image' => '1280px by 500px'
    ) );
}


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function BIGPIX_register_sidebars() {
  register_sidebar(array(
    'id' => 'sidebar3',
    'name' => __( 'Homepage Menu Widget Area', 'BIGPIX' ),
    'description' => __( 'The Menu Widget Area.', 'BIGPIX' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar1',
    'name' => __( 'Posts Menu Widget Area', 'BIGPIX' ),
    'description' => __( 'The Posts Menu Widget Area.', 'BIGPIX' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Page Menu Widget Area', 'BIGPIX' ),
    'description' => __( 'The Page Menu Widget Area.', 'BIGPIX' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

   register_sidebar(array(
    'id' => 'sidebar5',
    'name' => __( 'Archive Menu Widget Area', 'BIGPIX' ),
    'description' => __( 'The Archive Menu Widget Area.', 'BIGPIX' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar4',
    'name' => __( 'Footer Widget Area', 'BIGPIX' ),
    'description' => __( 'The Footer Widget Area.', 'BIGPIX' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));





} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function BIGPIX_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="//www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=100" class="load-gravatar avatar avatar-48 photo" height="100" width="100" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'BIGPIX' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'BIGPIX' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'BIGPIX' ),'  ','') ) ?>
        <br>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'BIGPIX' )); ?> </a></time>
        <?php comment_text() ?>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </section>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if ( ! function_exists( 'BIGPIX_theme_customizer' ) ) :
  function BIGPIX_theme_customizer( $wp_customize ) {
    
    $wp_customize->remove_section( 'title_tagline');
    $wp_customize->remove_section( 'static_front_page' );
  
  
    /* color scheme option */
    $wp_customize->add_setting( 'BIGPIX_color_settings', array (
      'default' => '#161616',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'BIGPIX_color_settings', array(
      'label'    => __( 'Primary Color Scheme', 'BIGPIX' ),
      'section'  => 'colors',
      'settings' => 'BIGPIX_color_settings',
    ) ) );


    $wp_customize->add_setting( 'BIGPIX_color_settings_2', array (
      'default' => '#656565',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'BIGPIX_color_settings_2', array(
      'label'    => __( 'Secondary Color Scheme', 'BIGPIX' ),
      'section'  => 'colors',
      'settings' => 'BIGPIX_color_settings_2',
    ) ) );

    $wp_customize->add_setting( 'BIGPIX_color_settings_3', array (
      'default' => '#fcff00',
      'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'BIGPIX_color_settings_3', array(
      'label'    => __( 'Button and link Color Scheme', 'BIGPIX' ),
      'section'  => 'colors',
      'settings' => 'BIGPIX_color_settings_3',
    ) ) );

    
    /* logo option */
    $wp_customize->add_section( 'BIGPIX_logo_section' , array(
      'title'       => __( 'Site Logo', 'BIGPIX' ),
      'priority'    => 1,
      'description' => __( 'Upload a logo to replace the default site name in the header', 'BIGPIX' ),
    ) );
    
    $wp_customize->add_setting( 'BIGPIX_logo', array(
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'BIGPIX_logo', array(
      'label'    => __( 'Choose your logo (ideal width is 100-350px and ideal height is 35-40)', 'BIGPIX' ),
      'section'  => 'BIGPIX_logo_section',
      'settings' => 'BIGPIX_logo',
    ) ) );
  
    /* favicon option */
    $wp_customize->add_section( 'BIGPIX_favicon_section' , array(
      'title'       => __( 'Site favicon', 'BIGPIX' ),
      'priority'    => 2,
      'description' => __( 'Upload a favicon', 'BIGPIX' ),
    ) );
    
    $wp_customize->add_setting( 'BIGPIX_favicon', array(
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'BIGPIX_favicon', array(
      'label'    => __( 'Choose your favicon (ideal width and height is 16x16 or 32x32)', 'BIGPIX' ),
      'section'  => 'BIGPIX_favicon_section',
      'settings' => 'BIGPIX_favicon',
    ) ) );
    
    /* social media option */
    $wp_customize->add_section( 'BIGPIX_social_section' , array(
      'title'       => __( 'Social Media Icons', 'BIGPIX' ),
      'priority'    => 32,
      'description' => __( 'Optional media icons in the header', 'BIGPIX' ),
    ) );
    
    $wp_customize->add_setting( 'BIGPIX_facebook', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_facebook', array(
      'label'    => __( 'Enter your Facebook url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_facebook',
      'priority'    => 101,
    ) ) );
  
    $wp_customize->add_setting( 'BIGPIX_twitter', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_twitter', array(
      'label'    => __( 'Enter your Twitter url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_twitter',
      'priority'    => 102,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_google', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_google', array(
      'label'    => __( 'Enter your Google+ url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_google',
      'priority'    => 103,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_pinterest', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_pinterest', array(
      'label'    => __( 'Enter your Pinterest url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_pinterest',
      'priority'    => 104,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_linkedin', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_linkedin', array(
      'label'    => __( 'Enter your Linkedin url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_linkedin',
      'priority'    => 105,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_youtube', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_youtube', array(
      'label'    => __( 'Enter your Youtube url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_youtube',
      'priority'    => 106,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_tumblr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_tumblr', array(
      'label'    => __( 'Enter your Tumblr url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_tumblr',
      'priority'    => 107,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_instagram', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_instagram', array(
      'label'    => __( 'Enter your Instagram url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_instagram',
      'priority'    => 108,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_flickr', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_flickr', array(
      'label'    => __( 'Enter your Flickr url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_flickr',
      'priority'    => 109,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_vimeo', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_vimeo', array(
      'label'    => __( 'Enter your Vimeo url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_vimeo',
      'priority'    => 110,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_yelp', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_yelp', array(
      'label'    => __( 'Enter your Yelp url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_yelp',
      'priority'    => 111,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_rss', array (
      'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_rss', array(
      'label'    => __( 'Enter your RSS url', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_rss',
      'priority'    => 112,
    ) ) );
    
    $wp_customize->add_setting( 'BIGPIX_email', array (
      'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_email', array(
      'label'    => __( 'Enter your email address', 'BIGPIX' ),
      'section'  => 'BIGPIX_social_section',
      'settings' => 'BIGPIX_email',
      'priority'    => 113,
    ) ) );
    
    /* slider options */
    
    $wp_customize->add_section( 'BIGPIX_slider_section' , array(
      'title'       => __( 'Slider Options', 'BIGPIX' ),
      'priority'    => 33,
      'description' => __( 'Adjust the behavior of the image slider.', 'BIGPIX' ),
    ) );
    
    $wp_customize->add_setting( 'BIGPIX_slider_effect', array(
      'default' => 'scrollHorz',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'BIGPIX_sanitize_select_slider',
    ));
    
    $wp_customize->add_control( 'effect_select_box', array(
      'settings' => 'BIGPIX_slider_effect',
      'label' => __( 'Select Effect:', 'BIGPIX' ),
      'section' => 'BIGPIX_slider_section',
      'type' => 'select',
      'choices' => array(
        'scrollHorz' => __('Horizontal (Default)','BIGPIX'),
        'scrollVert' => __('Vertical','BIGPIX'),
        'tileSlide' => __('Tile Slide','BIGPIX'),
        'tileBlind' => __('Blinds','BIGPIX'),
        'shuffle' => __('Shuffle','BIGPIX'),
      ),
    ));
    
    $wp_customize->add_setting( 'BIGPIX_slider_timeout', array (
      'sanitize_callback' => 'BIGPIX_sanitize_integer',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'BIGPIX_slider_timeout', array(
      'label'    => __( 'Autoplay Speed in Seconds', 'BIGPIX' ),
      'section'  => 'BIGPIX_slider_section',
      'settings' => 'BIGPIX_slider_timeout',
    ) ) );

     /* author bio in posts option */
    $wp_customize->add_section( 'BIGPIX_author_bio_section' , array(
      'title'       => __( 'Disable Author Bio', 'BIGPIX' ),
      'priority'    => 35,
      'description' => __( 'Option to disable the author bio in the posts.', 'BIGPIX' ),
    ) );
    
    $wp_customize->add_setting( 'BIGPIX_author_bio', array (
      'sanitize_callback' => 'BIGPIX_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('author_bio', array(
      'settings' => 'BIGPIX_author_bio',
      'label' => __('Disable the Author Bio?', 'BIGPIX'),
      'section' => 'BIGPIX_author_bio_section',
      'type' => 'checkbox',
    ));

    /* related posts option */
    $wp_customize->add_section( 'BIGPIX_related_posts_section' , array(
      'title'       => __( 'Disable Related Posts', 'BIGPIX' ),
      'priority'    => 36,
      'description' => __( 'Option to disable the related posts in the posts.', 'BIGPIX' ),
    ) );
    
    $wp_customize->add_setting( 'BIGPIX_related_posts', array (
      'sanitize_callback' => 'BIGPIX_sanitize_checkbox',
    ) );
    
    $wp_customize->add_control('related_posts', array(
      'settings' => 'BIGPIX_related_posts',
      'label' => __('Disable the Related Posts?', 'BIGPIX'),
      'section' => 'BIGPIX_related_posts_section',
      'type' => 'checkbox',
    ));
    
    $wp_customize->remove_section( 'nav');
  
  }
endif;
add_action('customize_register', 'BIGPIX_theme_customizer');


/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'BIGPIX_sanitize_checkbox' ) ) :
  function BIGPIX_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
      return 1;
    } else {
      return '';
    }
  }
endif;

/**
 * Sanitize select slider
 */

if ( ! function_exists( 'BIGPIX_sanitize_select_slider' ) ) :
  function BIGPIX_sanitize_select_slider( $input ) {
   
    $valid = array(
    'scrollHorz' => 'Horizontal (Default)',
    'scrollVert' => 'Vertical',
    'tileSlide' => 'Tile Slide',
    'tileBlind' => 'Blinds',
    'shuffle' => 'Shuffle',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
  }
endif;

/**
 * Sanitize integer input
 */
if ( ! function_exists( 'BIGPIX_sanitize_integer' ) ) :
  function BIGPIX_sanitize_integer( $input ) {
    return absint($input);
  }
endif;
/**
* Apply Color Scheme
*/
if ( ! function_exists( 'BIGPIX_apply_color' ) ) :
  function BIGPIX_apply_color() {
    if ( get_theme_mod('BIGPIX_color_settings') ) {
   ?>
  <style>
      .blog-list .item .hover-ovelay:hover{background: <?php esc_attr_e( get_theme_mod('BIGPIX_color_settings') ); ?>!important;}
      body .pagination li a{color: <?php esc_attr_e( get_theme_mod('BIGPIX_color_settings') ); ?>;}
      #main-navigation,.full-top-area,footer.footer[role="contentinfo"]{background: <?php esc_attr_e( get_theme_mod('BIGPIX_color_settings') ); ?>; }
    </style>
   <?php
    }
    ?>
  <?php  if ( get_theme_mod('BIGPIX_color_settings_2') ) {
   ?>
    <style>
      .blog-list li .excerpt p,.blog-list .item a,.blog-list .item .date,.blog-list .item time,body .byline.blog,
      .entry-content p,body .byline.blog a,body .info p.author-desc, body .related ul li .related-info p,body .comment time a,body .comment_content p,footer.footer[role="contentinfo"] .wp-caption p.wp-caption-text{color:<?php esc_attr_e( get_theme_mod('BIGPIX_color_settings_2') ); ?>;}
      body .pagination li:first-child{border-left: 2px solid <?php esc_attr_e( get_theme_mod('BIGPIX_color_settings_2') ); ?>; }
      body .pagination li{border: 2px solid <?php esc_attr_e( get_theme_mod('BIGPIX_color_settings_2') ); ?>;}
    </style>

   <?php 
    } ?>
    <?php  if ( get_theme_mod('BIGPIX_color_settings_3') ) {
   ?>
    <style>
      .short-divider,body .pagination,body .divider-posted,.blue-btn, .comment-reply-link, #submit,#main-navigation .widget #wp-calendar caption, #main-navigation .wp-caption, #main-navigation button, html #main-navigation input[type="button"], #main-navigation input[type="reset"], #main-navigation input[type="submit"]
      ,.error404 .searchform input[type="submit"],.footer-widgets .widget #wp-calendar caption,.wp-caption{background:<?php esc_attr_e( get_theme_mod('BIGPIX_color_settings_3') ); ?>; }
      .blog-list li .excerpt p a,.blog-list .item a[rel="author"],body .info p.author-desc a,body .related ul li a
      ,body .comment-reply-link,.blog-list .item h2:hover,#main-navigation .widgettitle,.social-icons a .fa:hover,footer.footer[role="contentinfo"] a:hover,.entry-content p a,#main-navigation a:hover,.no-menu-widgets p{color:<?php esc_attr_e( get_theme_mod('BIGPIX_color_settings_3') ); ?>;}
      .entry-content blockquote{border-left: 3px solid <?php esc_attr_e( get_theme_mod('BIGPIX_color_settings_3') ); ?>;}
    </style>

   <?php 
    }
    
  }
endif;
add_action( 'wp_head', 'BIGPIX_apply_color' );
/*-----------------------------------------------------------------------------------*/
/* custom functions below */
/*-----------------------------------------------------------------------------------*/

define('BIGPIX_THEMEURL', get_template_directory_uri());
define('BIGPIX_IMAGES', BIGPIX_THEMEURL.'/images'); 
define('BIGPIX_JS', BIGPIX_THEMEURL.'/js');
define('BIGPIX_CSS', BIGPIX_THEMEURL.'/css');

if(is_user_logged_in()){
  add_action( 'wp_head', 'BIGPIX_user_login' );
  function BIGPIX_user_login(){ ?>
    <style>#main-navigation{top: 30px!important;}</style>
    <?php
  }
}

add_filter( 'post_thumbnail_html', 'BIGPIX_remove_thumbnail_dimensions', 10, 3 );
function BIGPIX_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_filter( 'the_content', 'BIGPIX_remove_br_gallery', 11, 2);
function BIGPIX_remove_br_gallery($output) {
    return preg_replace('/<br style=(.*)>/mi','',$output);
}

function BIGPIX_author_excerpt() {
      $text_limit = 50; //Words to show in author bio excerpt
      $read_more  = __('Read more','BIGPIX'); //Read more text
      $end_of_txt = "...";
      $url_of_author  = get_author_posts_url(get_the_author_meta('ID'));
      $short_desc_author = wp_trim_words(strip_tags(
                          get_the_author_meta('description')), $text_limit, 
                          $end_of_txt.'<br/>
                        <a href="'.$url_of_author.'" style="font-weight:bold;">'.$read_more .'</a>');

      return $short_desc_author;
   }

function BIGPIX_catch_that_image() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_url($id);  
        return $transformed_content;
      }
    }
  }
  
}

function BIGPIX_catch_that_image_thumb() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_image($id,'thumbnail');  
         return $transformed_content;
      }
    }
  }
 
}

function BIGPIX_catch_gallery_image_full()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        $link = wp_get_attachment_url( $id );
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $link;
          return $first_img;
        }
      }
    } 
}

function BIGPIX_catch_gallery_image_thumb()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        
        $image  = wp_get_attachment_image( $id, 'thumbnail');
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $image;
          return $first_img;
        }
      }
    } 
}
/* social icons*/
function BIGPIX_social_icons()  { 
  $social_networks = array(
      "BIGPIX_facebook" => "fa-facebook", "BIGPIX_twitter" => "fa-twitter", "BIGPIX_google" => "fa-google-plus",
      "BIGPIX_pinterest" => "fa-pinterest", "BIGPIX_linkedin" => "fa-linkedin", "BIGPIX_youtube" => "fa-youtube",
      "BIGPIX_tumblr" => "fa-tumblr", "BIGPIX_instagram" => "fa-instagram", "BIGPIX_flickr" => "fa-flickr",
      "BIGPIX_vimeo" => "fa-vimeo-square", "BIGPIX_rss" => "fa-rss"
  );

  foreach ($social_networks as $key => $icon) {
     
      if (get_theme_mod( $key )): ?>
       <a href="<?php echo esc_url( get_theme_mod($key) ); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod( $key ) ); ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>
      <?php endif;
  }

  if(get_theme_mod('BIGPIX_email')): ?>
        <a href="mailto:<?php echo esc_attr(get_theme_mod('BIGPIX_email')); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod('BIGPIX_email')); ?>" target="_blank"><i class="fa fa-envelope"></i> </i></a>
  <?php endif;
}
/**
 *
 * This script will prompt the users to install the plugin required to
 * enable the "Menu Item" custom post type for magazino theme.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.3.6
 * @author     Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/library/class/class-tgm.php';

add_action( 'BIGPIX_register', 'BIGPIX_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the BIGPIX library
 * and one from the .org repo.
 *
 * The variable passed to BIGPIX_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into BIGPIX_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function BIGPIX_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Advanced Custom Fields',
            'slug'      => 'advanced-custom-fields',
            'required'  => false,
        ),
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'BIGPIX-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'BIGPIX' ),
            'menu_title'                      => __( 'Install Plugins', 'BIGPIX' ),
            'installing'                      => __( 'Installing Plugin: %s', 'BIGPIX' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'BIGPIX' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'BIGPIX' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'BIGPIX' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'BIGPIX' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    BIGPIX( $plugins, $config );
 
}
/* DON'T DELETE THIS CLOSING TAG */ ?>
<?php

// remove injected CSS for recent comments widget
function BIGPIX_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function BIGPIX_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function BIGPIX_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

		// modernizr (without media query polyfill)
		wp_enqueue_script( 'BIGPIX-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array('jquery'), '2.5.3', false );

		
		wp_enqueue_style( 'BIGPIX-scroll-style', get_template_directory_uri() . '/library/css/jquery.mCustomScrollbar.css', array(), '', 'all' );
		wp_enqueue_style( 'BIGPIX-font', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '', 'all' );
		// ie-only style sheet
		wp_enqueue_style( 'BIGPIX-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), '' );

		// register main stylesheet
		wp_enqueue_style('BIGPIX-raleway-fonts', get_template_directory_uri() . '/fonts/fonts.css');
		wp_enqueue_style( 'BIGPIX-stylesheet', get_template_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );
		wp_enqueue_style( 'BIGPIX-main-stylesheet', get_stylesheet_uri(), array(), '', 'all' );

	    // comment reply script for threaded comments
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
	    }

		//adding scripts file in the footer
		wp_enqueue_script( 'BIGPIX-scroll-js', get_template_directory_uri() . '/library/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'BIGPIX-js', get_template_directory_uri() . '/library/js/scripts.js', array('jquery'), '', true );

		if ( is_home() || is_front_page() ){
			wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/library/js/imagesloaded.pkgd.js', array('jquery'), '', true);
			wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/library/js/jquery.cycle2.js', array('jquery'), '', true );
			wp_enqueue_script( 'cycle2_tile', get_template_directory_uri() . '/library/js/jquery.cycle2.tile.js' , array('jquery'), '', true);
			wp_enqueue_script( 'cycle2_shuffle', get_template_directory_uri() . '/library/js/jquery.cycle2.shuffle.js', array('jquery'), '', true );
			wp_enqueue_script( 'cycle2_scrollvert', get_template_directory_uri() . '/library/js/jquery.cycle2.scrollVert.js', array('jquery'), '', true );
			wp_enqueue_script( 'BIGPIX-scripts-home', get_template_directory_uri() . '/library/js/scripts-home.js', array('jquery'), '', true );
		}
		$wp_styles->add_data( 'BIGPIX-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

}
/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function BIGPIX_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );
	add_editor_style(get_template_directory_uri(). '/library/css/editor-style.css');
	// default thumb size
	set_post_thumbnail_size(125, 125, true);
	
	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',    // background image default
	    'default-color' => 'ffffff',    // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	add_theme_support( 'title-tag' );

} /* end bigpix theme support */


if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function BIGPIX_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
    add_action( 'wp_head', 'BIGPIX_render_title' );
    
    add_filter( 'wp_title', 'BIGPIX_rw_title', 10, 3 );
	function BIGPIX_rw_title( $title, $sep, $seplocation ) {
	  global $page, $paged;

	  // Don't affect in feeds.
	  if ( is_feed() ) return $title;

	  // Add the blog's name
	  if ( 'right' == $seplocation ):
	    $title .= get_bloginfo( 'name' );
	  else:
	    $title = get_bloginfo( 'name' ) . $title;
	  endif;

	  // Add the blog description for the home/front page.
	  $site_description = get_bloginfo( 'description', 'display' );

	  if ( $site_description && ( is_home() || is_front_page() ) ):
	    $title .= " {$sep} {$site_description}";
	  endif;

	  // Add a page number if necessary:
	  if ( $paged >= 2 || $page >= 2 ):
	    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
	  endif;

	  return $title;

	} // end better title

endif;

/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using BIGPIX_related_posts(); )
function BIGPIX_related_posts() {
	echo '<ul id="BIGPIX-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) {
			$tag_arr = "";
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'BIGPIX' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_postdata();
	echo '</ul>';
} /* end bigpix related posts function */

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function BIGPIX_page_navi() {
  global $wp_query, $paged;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '<i class="fa fa-chevron-left"></i>',
    'next_text'    => '<i class="fa fa-chevron-right"></i>',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function BIGPIX_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function BIGPIX_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'BIGPIX' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'BIGPIX' ) .'</a>';
}

/*video*/

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_video',
		'title' => 'Video',
		'fields' => array (
			array (
				'key' => 'field_542906321cdab',
				'label' => __('Embed Video','BIGPIX'),
				'name' => 'wpdevshed_post_format_embed_video',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/*link*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_link',
		'title' => 'Link',
		'fields' => array (
			array (
				'key' => 'field_54290c22892fe',
				'label' => __('Link','BIGPIX'),
				'name' => 'wpdevshed_post_format_link_url',
				'type' => 'text',
				'instructions' => 'place url here',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'link',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/*quote*/
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_quote',
		'title' => 'Quote',
		'fields' => array (
			array (
				'key' => 'field_5428fc13708c4',
				'label' => __('Quote Content','BIGPIX'),
				'name' => 'wpdevshed_post_format_quote_content',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_5428fc4e3e3fc',
				'label' => __('Quote Source','BIGPIX'),
				'name' => 'wpdevshed_post_format_quote_source',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'quote',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_audio',
		'title' => 'Audio',
		'fields' => array (
			array (
				'key' => 'field_542a4c44cc3c2',
				'label' => __('Upload Audio File Here','BIGPIX'),
				'name' => 'wpdevshed_post_format_audio_content',
				'type' => 'file',
				'save_format' => 'url',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'audio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_status',
		'title' => 'Status',
		'fields' => array (
			array (
				'key' => 'field_542a5b07626a0',
				'label' => __('Insert Short Status Here','BIGPIX'),
				'name' => 'wpdevshed_post_format_status_content',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'status',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_chat',
		'title' => 'Chat',
		'fields' => array (
			array (
				'key' => 'field_542a5d28507df',
				'label' => __('Insert Chat Conversation here','BIGPIX'),
				'name' => 'wpdevshed_post_format_chat_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'chat',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
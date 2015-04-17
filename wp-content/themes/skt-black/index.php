<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Black
 */

get_header(); 
?>

<?php if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) : ?>

    <div class="content-area">
        <div class="middle-align content_sidebar">
            <div class="site-main" id="sitemain">
				<?php
                if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post();
                        /*
                         * Include the post format-specific template for the content. If you want to
                         * use this in a child theme, then include a file called called content-___.php
                         * (where ___ is the post format) and that will be used instead.
                         */
                        get_template_part( 'content', get_post_format() );
                
                    endwhile;
                    // Previous/next post navigation.
                    skt_black_pagination();
                
                else :
                    // If no content, include the "No posts found" template.
                     get_template_part( 'no-results', 'index' );
                
                endif;
                ?>
            </div>
            <?php get_sidebar();?>
            <div class="clear"></div>
        </div>
    </div>


<?php else: ?>

	<?php
    if( of_get_option('numsection', true) > 0 ) { 
        $numSections = esc_attr( of_get_option('numsection', true) );
        for( $s=1; $s<=$numSections; $s++ ){ 
            $title 			= ( of_get_option('sectiontitle'.$s, true) != '' ) ? esc_html( of_get_option('sectiontitle'.$s, true) ) : '';
			$secid			= ( of_get_option('menutitle'.$s, true) != '') ? esc_html( of_get_option('menutitle'.$s, true) ) : '';
            $class			= ( of_get_option('sectionclass'.$s, true) != '' ) ? esc_html( of_get_option('sectionclass'.$s, true) ) : '';
            $content		= ( of_get_option('sectioncontent'.$s, true) != '' ) ? of_get_option('sectioncontent'.$s, true) : ''; 
			$hide			= ( of_get_option('hidesec'.$s, true) != '' ) ? of_get_option('hidesec'.$s, true) : '';
            $bgcolor		= ( of_get_option('sectionbgcolor'.$s, true) != '' ) ? of_get_option('sectionbgcolor'.$s, true) : '';
            $bgimage		= ( of_get_option('sectionbgimage'.$s, true) != '' ) ? of_get_option('sectionbgimage'.$s, true) : '';
            ?>
            <section <?php if( $bgcolor || $bgimage || $hide) { ?>style="<?php echo ($bgcolor != '') ? 'background-color:'.$bgcolor.'; ' : '' ; echo ($bgimage != '') ? 'background-image:url('.$bgimage.'); background-repeat:no-repeat; background-position: center center; ' : '' ; echo ($hide) != false ? 'display:none;': ''; ?>"<?php } ?> id="<?php echo $secid; ?>" class="<?php echo ( of_get_option('menutitle'.$s, true) != '' ) ? 'menu_page' : '';?>">
            	<div class="container" <?php if($class == 'our-projects'){ ?>style="width:100%"<?php } ?>>
                    <div class="<?php echo ( ($s>22) && $class=='') ? 'top-grey-box' : $class; ?>">
                        <?php if( $title != '' ) { ?>
                        <h2><?php echo $title; ?></h2>
                    <?php } ?>
                    <?php echo $content; ?>
                     </div><!-- middle-align -->
                    <div class="clear"></div>
                    </div><!-- container -->
            </section><div class="clear"></div>
        
            <?php 
        }
    }
    ?>
<section class="menu_page" style="background-color:#000000;">
            	<div class="container">
                    <div class="latest-news"><h2>
                    						<?php if( of_get_option('logo',true) == 1) { 
												 	_e('Go to Appearance > Theme Options > Restore Defaults to setup the homepage','skt-black');
                                                } else { 
												_e('Latest News','skt-black'); 
												} ?>
                                    		</h2>
                                 <?php query_posts('showposts=2'); ?>
                                 <?php $k = 0; ?>
                                 <?php while( have_posts() ) : the_post(); ?>
                                 	<?php $k++; ?>
                                        <div class="news-box <?php if($k%2==0){?>last<?php } ?>">
											<div class="news">
												<?php if( has_post_thumbnail()){ 
                                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                                                $imgUrl = $large_image_url[0];
                                                } else {
                                                    $imgUrl = get_template_directory_uri().'/images/img_404.png';
                                                }
                                                ?>
                								<a href="<?php the_permalink(); ?>"><img alt=" " src="<?php echo $imgUrl; ?>"></a>
                								<h2><?php the_title(); ?></h2>
                        						<p><?php the_excerpt(); ?></p>
                    							<a class="more" href="<?php esc_url(the_permalink()); ?>"></a>
                    						</div>
                        				</div><?php if($k%2==0){ ?><div class="clear"></div><?php } ?>
                    			<?php endwhile; ?>
                    			<?php wp_reset_query(); ?>
                     </div><!-- latest-news -->
                    <div class="clear"></div>
                    </div><!-- container -->
            </section>
<?php endif; ?>



<?php get_footer(); ?>
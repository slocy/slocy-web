<?php
/**
 * The template for displaying Archive pages.
 *
 */
get_header(); ?>

<div class="page-header">
    <div class="site-container">
        <h1>
            <?php
            if ( is_category() ) :
                single_cat_title();
                
            elseif ( is_tag() ) :
                single_tag_title();
                
            elseif ( is_author() ) :
                /* Queue the first post, that way we know
                 * what author we're dealing with (if that is the case).
                */
                the_post();
                printf( __( 'Author: %s', 'albar' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
                /* Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();
                
            elseif ( is_day() ) :
                printf( __( 'Day: %s', 'albar' ), '<span>' . get_the_date() . '</span>' );
                
            elseif ( is_month() ) :
                printf( __( 'Month: %s', 'albar' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
                
            elseif ( is_year() ) :
                printf( __( 'Year: %s', 'albar' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
                
            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                _e( 'Asides', 'albar' );
                
            elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                _e( 'Images', 'albar');
                
            elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                _e( 'Videos', 'albar' );
                
            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                _e( 'Quotes', 'albar' );
                
            elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                _e( 'Links', 'albar' );
                
            else :
                _e( 'Archives', 'albar' );
                
            endif; ?>
            
            <?php
            // Show an optional term description.
            $term_description = term_description();
            if ( ! empty( $term_description ) ) :
                printf( '<div class="taxonomy-description">%s</div>', $term_description );
            endif; ?>
        </h1>
        <div class="cx-breadcrumbs">
            <?php
            if(function_exists('bcn_display')) {
                bcn_display();
            } else {
                
            } ?>
        </div>
    </div>
</div>

<div class="site-body site-pad">
    <div class="site-container">
        
        <div id="primary" class="content-area">
			
			<?php if ( have_posts() ) : ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					
				<?php endwhile; ?>
				
				<?php kaira_content_nav( 'nav-below' ); ?>
				
			<?php else : ?>
				
				<?php get_template_part( 'no-results', 'archive' ); ?>
				
			<?php endif; ?>
			
        </div><!-- #primary -->
        
        <?php get_sidebar(); ?>
        
    </div>
</div>
<?php get_footer(); ?>
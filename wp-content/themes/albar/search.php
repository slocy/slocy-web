<?php
/**
 * The template for displaying Search Results pages.
 *
 */
get_header(); ?>

<div class="site-body site-pad">
	<div class="site-container">
	
    	<section id="primary" class="content-area">
    		
    		<?php if ( have_posts() ) : ?>
    			
    			<header class="page-header">
    				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'albar' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    			</header><!-- .page-header -->
    			
    			<?php while ( have_posts() ) : the_post(); ?>
    				
    				<?php get_template_part( 'content', 'search' ); ?>
    				
    			<?php endwhile; ?>
    			
    			<?php kaira_content_nav( 'nav-below' ); ?>
    			
    		<?php else : ?>
    			
    			<?php get_template_part( 'no-results', 'search' ); ?>
    			
    		<?php endif; ?>
    		
    	</section><!-- #primary -->
        
        <?php get_sidebar(); ?>
	
	</div>
</div>
<?php get_footer(); ?>
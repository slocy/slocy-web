<?php
/**
 *
 * Template Name: Left Sidebar
 *
 */
get_header(); ?>
	
<?php get_template_part('pageheader'); ?>

<div class="site-body site-pad">
	<div class="site-container">
		
		<?php get_sidebar(); ?>
		
		<div id="primary" class="content-area">
			
			<?php if ( have_posts() ) : ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'page' ); ?>
					
				<?php endwhile; ?>
				
				<?php kaira_content_nav( 'nav-below' ); ?>
				
			<?php else : ?>
				
				<?php get_template_part( 'no-results', 'index' ); ?>
				
			<?php endif; ?>
			
		</div><!-- #primary -->
		
	</div>
</div>
<?php get_footer(); ?>
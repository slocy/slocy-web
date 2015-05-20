<?php
/**
 * The Template for displaying all single posts.
 *
 */
get_header(); ?>

<?php get_template_part('pageheader'); ?>

<div class="site-body site-pad">
	<div class="site-container">
		
		<div id="primary" class="content-area">
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'content', 'single' ); ?>
				
				<?php kaira_content_nav( 'nav-below' ); ?>
				
				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template(); ?>
				
			<?php endwhile; // end of the loop. ?>
			
		</div><!-- #primary -->
		
		<?php get_sidebar(); ?>
		
	</div>
</div>
<?php get_footer(); ?>
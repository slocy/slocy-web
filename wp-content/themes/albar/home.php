<?php get_header(); ?>

<?php if ( is_home() ) : ?>
    
    <?php get_template_part('pageheader'); ?>
    
<?php endif; ?>

<div class="site-body site-pad">
	<div class="site-container blog-standard-layout">
		
		<div id="primary" class="content-area content-area-full">
			<div id="content" class="site-content site-content-full" role="main">
			
			<?php if ( have_posts() ) : ?>
                
                <?php if ( is_home() ) : ?>
                
                        <?php
                        // Standard Layout
                        get_template_part( '/includes/blog/blog-standard' ); ?>
				
                <?php else: ?>
                    
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
                    
                <?php endif; ?>
				
			<?php else : ?>
				
				<?php get_template_part( 'no-results', 'index' ); ?>
				
			<?php endif; ?>
			
			</div><!-- #content -->
		</div><!-- #primary -->
		
	</div>
</div>
<?php get_footer(); ?>
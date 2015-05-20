<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */
get_header(); ?>
<div class="site-body site-pad">
	<div class="site-container">
		
		<div id="primary" class="content-area-full">
			<div id="content" class="site-content" role="main">
				
				<article id="post-0" class="post not-found">
                    <i class="fa fa-ban"></i>
                    
					<header class="entry-header">
						<h1 class="entry-title"><?php echo wp_kses_post( kaira_theme_option( 'kra-website-error-head' ) ) ?></h1>
					</header><!-- .entry-header -->
					
					<div class="entry-content">
						<p><?php echo wp_kses_post( kaira_theme_option( 'kra-website-error-msg' ) ) ?></p>
						
						<div class="not-found-options">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="alba-button"><?php esc_html_e( 'Return Home', 'albar' ) ?></a>
                            <a class="alba-button search-button"><?php esc_html_e( 'Search', 'albar' ) ?></a>
                        </div>
						
					</div><!-- .entry-content -->
				</article><!-- #post-0 .post .not-found -->
				
			</div><!-- #content -->
		</div><!-- #primary -->
		
	</div>
</div>
<?php get_footer(); ?>
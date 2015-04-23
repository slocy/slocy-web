<?php
/*
 * This template is used for the display of 404 (Not Found) errors.
 */

get_header(); ?>

<section class="content-container">

	<!--Post Loop -->
	<article class="content">

		<section class="404-error no-posts post-container">
			<article class="page-content">
				<header class="post-header">
					<h1 title="<?php _e( '404 Error', 'simple-shop' ); ?>" class="page-title">
						<span class="fancy">
							<?php _e( '404 Error', 'simple-shop' ); ?>
						</span>
					</h1>
				</header>

				<p><?php _e( 'We apologize but something when wrong while trying to find what you were looking for. Please use the navigation below to navigate to your destination.', 'simple-shop' ); ?></p>

				<section id="search-again" class="search-again search-block no-posts no-search-results">
					<p><?php _e( 'Search:', 'simple-shop' ); ?></p>
					<?php echo get_search_form(); ?>
				</section>

				<?php sds_sitemap(); ?>
			</article>
		</section>

		<!-- Sidebar -->
		<?php get_sidebar(); ?>

	</article>

</section>

<?php get_footer(); ?>
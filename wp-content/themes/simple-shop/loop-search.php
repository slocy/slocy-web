<?php
	if ( have_posts() ) : // Search results
?>
	<header class="search-title archive-title">
		<h1 title="<?php esc_attr_e( sprintf( __( 'Search results for \'%s\'', 'simple-shop' ), get_search_query() ) ); ?>" class="page-title block-title">
			<?php printf( __( 'Search results for "%s"', 'simple-shop' ), get_search_query() ); ?>
		</h1>
	</header>

	<?php while ( have_posts() ) : the_post(); ?>
		<section id="<?php the_ID(); ?>" <?php post_class( ( has_post_thumbnail() ) ? 'block-3 latest-post cf' : 'block-3 latest-post has-image-placeholder cf' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php sds_featured_image( true, 'simple-shop-425x280' ); ?>
			<?php else: ?>
				<div class="post-image post-image-placeholder">
					<a href="<?php the_permalink(); ?>">
						<div class="dashicons dashicons-images-alt2"></div>
					</a>
				</div>
			<?php endif; ?>

			<article class="post-info">
				<a href="<?php the_permalink(); ?>">
					<?php if ( strlen( get_the_title() ) > 0 ) : ?>
						<h2 class="post-title"><?php the_title(); ?></h2>
					<?php else: // No title ?>
						<h2 class="post-title"><?php echo get_the_time( get_option( 'date_format' ) ); ?></h2>
					<?php endif; ?>
				</a>
			</article>
		</section>
	<?php endwhile; ?>
<?php else : // No search results ?>
		<header class="search-title archive-title">
			<h1 title="<?php esc_attr_e( sprintf( __( 'No results for \'%s\'', 'simple-shop' ), get_search_query() ) ); ?>'" class="page-title block-title">
				<?php printf( __( 'No results for "%s"', 'simple-shop' ), get_search_query() ); ?>
			</h1>
		</header>

		<section class="no-results no-posts no-search-results page-content">
			<?php sds_no_posts(); ?>

			<section id="search-again" class="search-again search-block no-posts no-search-results">
				<p><?php _e( 'Would you like to search again?', 'simple-shop' ); ?></p>
				<?php echo get_search_form(); ?>
			</section>
		</section>
<?php endif; ?>
<?php // Loop through posts
	global $multipage;

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>
		<article id="<?php the_ID(); ?>" <?php post_class( 'post-content single-post cf' ); ?>>
			<?php if ( has_post_thumbnail() ): ?>
				<figure class="featured-image">
					<?php the_post_thumbnail( false, 'simple-shop-1400x600' ); ?>
				</figure>
			<?php endif; ?>

			<section class="post-inner-content">
				<header class="post-header">
					<p class="date"><?php the_time( get_option( 'date_format' ) ); ?></p>

					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>

				<?php the_content(); ?>

				<div class="clear"></div>

				<?php edit_post_link( __( 'Edit Post', 'simple-shop' ) ); // Allow logged in users to edit ?>

				<div class="clear"></div>

				<section class="post-meta">
					<?php sds_post_meta(); ?>
				</section>

				<?php if ( $multipage ) : ?>
					<section class="single-post-navigation single-post-pagination wp-link-pages">
						<?php wp_link_pages(); ?>
					</section>
				<?php endif; ?>

				<!-- Pagination -->
				<?php sds_single_post_navigation(); ?>

				<?php get_template_part( 'post', 'author' ); // Author Details ?>
			</section>

		</article>

		<div class="clear"></div>
<?php
		endwhile;
	endif;
?>
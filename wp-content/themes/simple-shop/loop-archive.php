<header class="archive-title">
	<?php sds_archive_title(); ?>
</header>

<?php
	// Loop through posts
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>
			<section id="<?php the_ID(); ?>" <?php post_class(  ( has_post_thumbnail() ) ? 'block-3 latest-post cf' : 'block-3 latest-post has-image-placeholder cf' ); ?>>

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
<?php
		endwhile;
	else: // No Posts
?>
	<section class="no-results no-posts no-archive-results post">
		<?php sds_no_posts(); ?>
	</section>
<?php
	endif;
?>
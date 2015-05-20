<?php
	global $multipage;

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
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</a>

				<?php edit_post_link( __( 'Edit Post', 'simple-shop' ) ); // Allow logged in users to edit ?>
			</article>
		</section>
<?php
		endwhile;
	endif;
?>
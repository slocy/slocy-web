<?php
	global $multipage;

	// Loop through posts
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>

		<?php sds_featured_image( false, 'simple-shop-1600x9999' ); ?>

		<article id="<?php the_ID(); ?>" <?php post_class( 'page-content cf' ); ?>>
			<header class="post-header">
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
			</header>

			<?php the_content(); ?>

			<div class="clear"></div>

			<?php edit_post_link( __( 'Edit Page', 'simple-shop' ) ); // Allow logged in users to edit ?>

			<div class="clear"></div>

			<?php if ( $multipage ) : ?>
				<section class="single-post-navigation single-post-pagination wp-link-pages">
					<?php wp_link_pages(); ?>
				</section>
			<?php endif; ?>

		</article>
<?php
		endwhile;
	endif;
?>
<?php
/*
 * This template is used for the display images.
 */

get_header(); ?>

	<section class="content-container image-content image-attachment image cf">

		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<?php get_template_part( 'loop', 'attachment-image' ); ?>

				<?php comments_template(); // Comments ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
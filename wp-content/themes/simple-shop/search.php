<?php
/*
 * This template is used for the display of search results.
 */

get_header(); ?>

	<section class="content-container search-content search cf">

		<!--Post Loop -->
		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<?php get_template_part( 'loop', 'search' ); ?>

				<?php get_template_part( 'post', 'navigation' ); // Post Navigation ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
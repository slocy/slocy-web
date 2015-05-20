<?php
/*
 * This template is used for the display of archives.
 */

get_header(); ?>

	<section class="content-container">

		<!--Post Loop -->
		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<?php get_template_part( 'loop', 'archive' ); // Loop - Archive ?>

				<?php get_template_part( 'post', 'navigation' ); // Post Navigation ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
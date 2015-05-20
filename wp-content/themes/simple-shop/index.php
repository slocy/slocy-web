<?php
/*
 * This template is used for the display of all post types that do not have templates (used as a fallback).
 */

get_header(); ?>

	<section class="content-container">

		<!--Post Loop -->
		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<?php get_template_part( 'loop' ); ?>

				<?php get_template_part( 'post', 'navigation' ); // Post Navigation ?>

				<?php comments_template(); ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
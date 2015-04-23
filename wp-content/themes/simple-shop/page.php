<?php
/*
 * This template is used for the display of single pages.
 */
get_header(); ?>

	<!-- Home Content -->
	<section class="content-container">

		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<div class="post-wrapper">
					<?php get_template_part( 'loop', 'page' ); ?>
				</div>

				<?php comments_template(); ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
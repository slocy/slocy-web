<?php
/*
 * Template Name: Full Width
 * This template is used for the display of full width single pages.
 */

get_header(); ?>

	<!-- Home Content -->
	<section class="content-container full-width-content-wrapper full-width-content-container">

		<article class="content full-width-content cf">

			<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

			<section class="post-container">

				<div class="post-wrapper">
					<?php get_template_part( 'loop', 'page' ); ?>
				</div>

				<?php comments_template(); ?>

			</section>

		</article>

	</section>

<?php get_footer(); ?>
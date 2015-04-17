<?php
/*
 * Template Name: Landing Page
 * This template is used for the display of landing pages.
 */

get_header( 'landing-page' ); ?>

	<!-- Home Content -->
	<section class="content-container full-width-content-wrapper full-width-content-container">

		<article class="content full-width-content cf">

			<section class="post-container">

				<div class="post-wrapper">
					<?php get_template_part( 'loop', 'page' ); ?>
				</div>

				<?php comments_template(); ?>

			</section>

		</article>

	</section>

<?php get_footer( 'landing-page' ); ?>
<?php
/*
 * This template is used for displaying the Front Page (when selected in Settings > Reading).
 *
 * This template is used even when the option is selected, but a page is not. It contains fallback functionality
 * to ensure content is still displayed.
 */

get_header(); ?>

	<section class="content-container">

		<article class="content">
			<?php
				// Front page is active
				if ( get_option( 'show_on_front' ) === 'page' && get_option( 'page_on_front' ) ) :
					sds_front_page_slider_sidebar(); // Front Page Slider Sidebar
			?>
				<?php if ( is_active_sidebar( 'front-page-sidebar' ) ) : // Front Page Sidebar ?>
					<section class="post-container">

						<div id="front-page-sidebar" class="blocks">

							<?php dynamic_sidebar( 'front-page-sidebar' ); ?>

						</div>

					</section>
				<?php else: ?>
					<section class="post-container">

						<?php get_template_part( 'loop', 'page' ); // Loop - Page ?>

					</section>
				<?php endif; ?>
			<?php
				// No "Front Page" Selected, show posts
				else:
			?>
				<section class="post-container">

					<?php
						get_template_part( 'loop', 'home' ); // Loop - Home
						get_template_part( 'post', 'navigation' ); // Post Navigation
					?>

				</section>
			<?php
				endif;
			?>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>
		</article>

	</section>

<?php get_footer(); ?>
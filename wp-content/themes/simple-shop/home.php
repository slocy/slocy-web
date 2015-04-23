<?php
/**
 * This template is used for the display of blog posts (archive; river).
 */

get_header(); ?>

	<section class="content-container">

		<!--Post Loop -->
		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<h1 class="block-title"><span class="fancy"><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></span></h1>

				<?php get_template_part( 'loop', 'home' ); ?>

				<?php get_template_part( 'post', 'navigation' ); // Post Navigation ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
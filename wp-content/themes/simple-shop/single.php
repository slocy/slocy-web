<?php
get_header(); ?>

	<section class="content-container">

		<!--Post Loop -->
		<article class="content">

			<section class="post-container">

				<?php get_template_part( 'yoast', 'breadcrumbs' ); // Yoast Breadcrumbs ?>

				<?php get_template_part( 'loop', 'single' ); ?>

				<?php comments_template(); ?>

			</section>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</article>

	</section>

<?php get_footer(); ?>
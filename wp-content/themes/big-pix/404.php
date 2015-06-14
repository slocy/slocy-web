<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class="cf">
				<header class="article-header full-top-area">
					<div class="bg-overlay"></div>
							<div class="table">
								<div class="table-cell">
									<h1><?php _e( 'Epic 404 - Article Not Found', 'BIGPIX' ); ?></h1>
									<div class="short-divider"></div>
									<a class="arrow fa fa-angle-down" href="#post-not-found"></a>
								</div>
							</div>
								
				</header>
				<div id="inner-content" class="wrap cf post-content-single">
					
					

						<article id="post-not-found" class="hentry cf full">


							<section class="entry-content">

								<p><?php _e( 'The article you were looking for was not found. You may want to check your link or perhaps that page does not exist anymore.', 'BIGPIX' ); ?></p>

							</section>

							<section class="search">

									<p><?php get_search_form(); ?></p>

							</section>

						</article>

					</div>

				

			</div>
		</div>

<?php get_footer(); ?>

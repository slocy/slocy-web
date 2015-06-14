<?php get_header(); ?>

	<div id="content">
		
		<div id="inner-content" class=" cf">
			<?php 
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				$thumb_url = $thumb_url_array[0]; 
			?>
			
			<?php if ( has_post_thumbnail()): ?>
			<header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');background-size:cover;background-position:center;position:relative;">
			<?php else: ?>	
			<header class="article-header full-top-area">
			<?php endif; ?>
				
				<div class="bg-overlay"></div>
				<div class="table">
					<div class="table-cell">
						<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<div class="short-divider"></div>
						<a class="arrow fa fa-angle-down" href="#page-content"></a>
					</div>
				</div>
			</header> <?php // end article header ?>

			<div id="inner-content" class="wrap cf post-content-single">
					<div id="page-content">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						<section class="entry-content cf" itemprop="articleBody">
							<?php
								// the content (pretty self explanatory huh)
								the_content();

								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'BIGPIX' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
							?>
						</section> <?php // end article section ?>

						

						<?php comments_template(); ?>

					</article>

					<?php endwhile; else : ?>

										<article id="post-not-found" class="hentry cf">
												<header class="article-header">
													<h1><?php _e( 'Oops, Post Not Found!', 'BIGPIX' ); ?></h1>
													<p><?php _e( 'Apologies, but no entries were found.', 'BIGPIX' ); ?></p>
												</header>
										</article>

					<?php endif; ?>

					</div>
				</div>

		</div>

	</div>

<?php get_footer(); ?>
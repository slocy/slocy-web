<?php get_header(); ?>

			<div id="content">
				<div id="inner-content" class=" cf">
					<?php 
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
						$thumb_url = $thumb_url_array[0];
						$image_full = BIGPIX_catch_that_image(); $gallery_full = BIGPIX_catch_gallery_image_full(); 
					?>

					<?php if ( has_post_thumbnail()) : ?>
						<header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');background-size:cover;background-position:center;position:relative;">
					
					<?php elseif(has_post_format('gallery') && !empty($gallery_full)): ?>
					     <header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $gallery_full ); ?>');background-size:cover;background-position:center;position:relative;">
					
					<?php elseif(has_post_format('image') && !empty($image_full)): ?>
						<header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $image_full ); ?>');background-size:cover;background-position:center;position:relative;">
					
					<?php else: ?>	
						<header class="article-header full-top-area">
					<?php endif; ?>

							<div class="bg-overlay"></div>
								<div class="table">
									<div class="table-cell">
										<?php if (is_category()) : ?>
										<h1 class="archive-title h2">
											<span><?php _e( 'Posts Categorized:', 'BIGPIX' ); ?></span> <?php single_cat_title(); ?>
										</h1>

										<?php elseif (is_tag()): ?>
										<h1 class="archive-title h2">
											<span><?php _e( 'Posts Tagged:', 'BIGPIX' ); ?></span> <?php single_tag_title(); ?>
										</h1>

										<?php elseif (is_author()) :
										global $post;
										$author_id = $post->post_author;
										?>
										<h1 class="archive-title h2">

											<span><?php _e( 'Posts By:', 'BIGPIX' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

										</h1>

										<?php elseif (is_day()): ?>
										<h1 class="archive-title h2">
											<span><?php _e( 'Daily Archives:', 'BIGPIX' ); ?></span> <?php the_time(get_option('date_format')); ?>
										</h1>

										<?php elseif (is_month()): ?>
											<h1 class="archive-title h2">
												<span><?php _e( 'Monthly Archives:', 'BIGPIX' ); ?></span> <?php the_time(get_option('date_format')); ?>
											</h1>

										<?php elseif (is_year()): ?>
											<h1 class="archive-title h2">
												<span><?php _e( 'Yearly Archives:', 'BIGPIX' ); ?></span> <?php the_time(get_option('date_format')); ?>
											</h1>
										<?php endif; ?>
										<div class="short-divider"></div>
										<a class="arrow fa fa-angle-down" href="#blog"></a>
									</div>
								</div>
								
						</header>

						<ul class="blog-list" id="blog">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php 
										$thumb_id = get_post_thumbnail_id();
										$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
										$thumb_url = $thumb_url_array[0];
										$image_full = BIGPIX_catch_that_image(); $gallery_full = BIGPIX_catch_gallery_image_full(); 
									?>

									<?php if ( has_post_thumbnail()): ?>
										<li class="item" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');background-size:cover;background-position:center;position:relative;">
									
									<?php elseif(has_post_format('gallery') && !empty($gallery_full)): ?>
									    <li class="item" style="background-image:url('<?php echo esc_url( $gallery_full ); ?>');background-size:cover;background-position:center;position:relative;">
									
									<?php elseif(has_post_format('image') && !empty($image_full)): ?>
										<li class="item" style="background-image:url('<?php echo esc_url( $image_full ); ?>');background-size:cover;background-position:center;position:relative;">
									
									<?php else: ?>	
										<li class="item">
									<?php endif; ?>
				  						<div class="hover-ovelay">
				  						<div class="wrap">
					  						<div class="the-post-title">
												<?php $category_list = get_the_category_list( __( ', ', 'BIGPIX' ) ); printf( __('%s', 'BIGPIX'), $category_list); ?>
												<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
												<div class="date"><?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> by ', 'BIGPIX' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?><?php the_author_posts_link(); ?></div>
											</div>
											<div class="excerpt"><?php the_excerpt(); ?></div>
											<div class="clear"></div>
										</div>
										</div>
											<div class="bg-overlay-2"></div>
											</li>
				  				<?php endwhile;  ?>
				  				<?php else : ?>

										<article id="post-not-found" class="hentry cf">
												<header class="article-header">
													<h1><?php _e( 'Oops, Post Not Found!', 'BIGPIX' ); ?></h1>
													<p><?php _e( 'Apologies, but no entries were found.', 'BIGPIX' ); ?></p>
												</header>
										</article>

	  							<?php endif; ?>
			     				<div class="clear"></div>
						</ul>
						<?php  BIGPIX_page_navi(); ?>
						<?php wp_reset_postdata(); ?>

				</div>

			</div>

<?php get_footer(); ?>
<?php get_header(); ?>

			<div id="content">
				
				<div id="inner-content" class=" cf">

						<?php 
							$thumb_id = get_post_thumbnail_id();
							$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
							$thumb_url = $thumb_url_array[0];
							$image_full = BIGPIX_catch_that_image(); $gallery_full = BIGPIX_catch_gallery_image_full(); 
						?>

						<?php if ( has_post_thumbnail()): ?>
							<header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');background-size:cover;background-position:center;position:relative;">
						
						<?php elseif(has_post_format('gallery') && !empty($gallery_full)): ?>
						     <header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $gallery_full ); ?>');background-size:cover;background-position:center;position:relative;">
						
						<?php elseif(has_post_format('image') && !empty($image_full)):  ?>
							<header class="article-header full-top-area" style="background-image:url('<?php echo esc_url( $image_full ); ?>');background-size:cover;background-position:center;position:relative;">
						
						<?php else: ?>	
							<header class="article-header full-top-area">

						<?php endif; ?>

								<div class="bg-overlay"></div>
								<div class="table">
									<div class="table-cell">
										<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
										<div class="short-divider"></div>
										<a class="arrow fa fa-angle-down" href="#blog"></a>
									</div>
								</div>
							</header> <?php // end article header ?>
						
						<div id="blog" class="divider-posted">
						<p class="byline vcard blog">
		                    <?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'BIGPIX' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
		                    <?php
		                      /* translators: used between list items, there is a space after the comma */
		                      $category_list = get_the_category_list( __( ', ', 'BIGPIX' ) );
		                      printf( __('under %s', 'BIGPIX'),
		                        $category_list
		                      );
		                    ?>
                		</p>

                		</div>
						<div id="inner-content" class="wrap cf post-content-single">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">
								<?php
									get_template_part( 'post-formats/format', get_post_format() );
								?>

								<?php 
									if ( get_theme_mod('BIGPIX_author_bio') ) :
										$author_class = 'author-hide';
									else:
										$author_class = '';
									endif;
								?>

				                <?php 
				                	if ( get_theme_mod('BIGPIX_related_posts') ) :
				                    	$related_class = 'related-hide';
				                    else:
				                    	$related_class = '';
				                    endif;
				                ?>

				                <!-- next/prev posts area -->
								<div class="next-prev-post">
									<div class="prev">
										<?php previous_post_link('<span>'. __('PREVIOUS POST','BIGPIX') . '</span> &larr; %link'); ?>
									</div>
									<div class="next">
										<?php next_post_link('<span>'. __('NEXT POST','BIGPIX') . '</span> %link &rarr;'); ?>
									</div>
									<div class="clear"></div>
								</div> <!-- next-prev-post -->

				                <footer class="article-footer <?php echo  esc_attr($author_class); ?>">
				                  <div class="avatar">
				                  	<?php echo get_avatar( get_the_author_meta( 'ID' ) , 150 ); ?>
				                  </div>
				                  <div class="info">
					                  <p class="author"><span><?php _e('Written by','BIGPIX'); ?></span> <?php the_author(); ?></p>
					                  <p class="author-desc"> <?php if (function_exists('BIGPIX_author_excerpt')){echo BIGPIX_author_excerpt();} ?> </p>
				                  </div>
				                  <div class="clear"></div>
				                </footer> <?php // end article footer ?>

				                <?php $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 4, 'post__not_in' => array($post->ID) ) ); ?>
				                    <?php if (!empty($related)) : ?>
					                    <div class="related posts <?php echo $related_class; ?>">
						                    <h3><?php _e('Related Posts','BIGPIX'); ?></h3>
						                    <ul> 
							                    <?php if( $related ): foreach( $related as $post ) { ?>
							                    <?php setup_postdata($post); ?>

						                            <li>
						                              <div class="related-image">
							                              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							                                <?php 
							                                	$image_thumb = BIGPIX_catch_that_image_thumb(); 
							                                	$gallery_thumb = BIGPIX_catch_gallery_image_thumb(); 
							                                ?>
							                                
							                                <?php if ( has_post_thumbnail()):
							                                	the_post_thumbnail('BIGPIX-thumb-image-300by300');
							                                
							                                elseif(has_post_format('gallery') && !empty($gallery_thumb)): 
							                                	echo esc_url($gallery_thumb); 
							                                
							                                elseif(has_post_format('image') && !empty($image_thumb)): 
							                                	echo esc_url($image_thumb); 
							                                else: ?>
							                                	<img src="<?php echo BIGPIX_IMAGES; ?>/blank.jpg">
							                                <?php endif; ?>
							                              </a>
						                              </div>

						                              <div class="related-info">
						                                  <h3><?php the_title(); ?></h3>
						                                  <?php the_excerpt(); ?>
						                                  <p class="byline vcard">
						                                      <?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> by ', 'BIGPIX' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?><?php the_author_posts_link(); ?>
						                                    
						                                  </p>
						                              </div>
						                               
						                            </li>
							                    
							                    <?php } endif; wp_reset_postdata(); ?>
							                    <div class="clear"></div>
						                      </ul>

					                     </div>
				                    <?php endif; ?>
               

               				<?php comments_template(); ?>

         					</article> <?php // end article ?>
						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'BIGPIX' ); ?></h1>
										<p><?php _e( 'Apologies, but no entries were found.', 'BIGPIX' ); ?></p>
									</header>
							</article>

						<?php endif; ?>

					</div>
					

					<!--<?php get_sidebar(); ?>-->

				</div>

			</div>

<?php get_footer(); ?>
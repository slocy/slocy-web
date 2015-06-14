<?php get_header(); ?>
	<div class="front-wrapper">
		
		<div id="content">
			
			<div id="slide-wrap" class="full-top-area">

				<?php 	
					$args = array('posts_per_page' => 10,'post_status' => 'publish','post__in' => get_option("sticky_posts"));
		        	$fPosts = new WP_Query( $args );
			    ?>

				<?php if ( $fPosts->have_posts() ) : ?>

					<div class="cycle-slideshow" 
							<?php if ( get_theme_mod('BIGPIX_slider_effect') ) :
								echo 'data-cycle-fx="' . wp_kses_post( get_theme_mod('BIGPIX_slider_effect') ) . '" data-cycle-tile-count="10"';
							else:
								echo 'data-cycle-fx="scrollHorz"';
							endif;?> 
						data-cycle-slides="> div.slides" 
							<?php if ( get_theme_mod('BIGPIX_slider_timeout') ): 
								$slider_timeout = wp_kses_post( get_theme_mod('BIGPIX_slider_timeout') );
								echo 'data-cycle-timeout="' . $slider_timeout . '000"';
							else:
								echo 'data-cycle-timeout="5000"';
							endif; ?> 
						data-cycle-prev="#sliderprev" data-cycle-next="#slidernext">


				<?php while ( $fPosts->have_posts() ) : $fPosts->the_post();  ?>

					<div class="slides">
							<div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>

							 <?php 
							 	$image_full = BIGPIX_catch_that_image(); 
							 	$gallery_full = BIGPIX_catch_gallery_image_full(); 
							 ?>

							 <?php if ( has_post_thumbnail()) : ?>
							    <div class="slide-thumb">
							    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							    		<?php the_post_thumbnail( "full" ); ?>
							    	</a>
							    	<div class="bg-overlay"></div>
							    </div>
							 <?php elseif(has_post_format('image') && !empty($image_full)) : ?>
								<div class="slide-thumb">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<img class="attachment-full" src="<?php echo esc_url($image_full); ?>">
									</a><div class="bg-overlay"></div>
								</div>
							 <?php elseif(has_post_format('gallery') && !empty($gallery_full)) : ?>  
							 	<div class="slide-thumb">
							 		<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							 			<img class="attachment-full" src="<?php echo esc_url($gallery_full); ?>">
							 		</a>
							 		<div class="bg-overlay"></div>
							 	</div>
							<?php else: ?>
								<div class="slide-noimg">
									<p><?php _e('No featured image set for this post.', 'BIGPIX') ?></p>
									<div class="bg-overlay"></div>
								</div>
							    
							   <?php endif; ?>

							</div>
						  
						 
							<div class="slide-copy-wrap">
								<div class="table">
									<div class="table-cell"> 
										<div class="slide-copy">
											<h2 class="slide-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read %s', 'BIGPIX' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
											<div class="short-divider"></div>
											<?php the_excerpt(); ?> 
											<a href="#blog" class="arrow fa fa-angle-down"></a>
										</div>
									</div>
								</div>
							</div>
					  
					</div>

				<?php endwhile; ?>

					<div class="slidernav">
						<a id="sliderprev" href="#" title="<?php _e('Previous', 'BIGPIX'); ?>"><?php _e('&#9664;', 'BIGPIX'); ?></a>
						<a id="slidernext" href="#" title="<?php _e('Next', 'BIGPIX'); ?>"><?php _e('&#9654;', 'BIGPIX'); ?></a>
					</div>

			</div>
				<?php endif; ?>

			<?php wp_reset_postdata(); ?>

			</div> <!-- slider-wrap -->
					
			<ul class="blog-list" id="blog">
					<?php $args2= array('post__not_in' => get_option( 'sticky_posts' ) ,'paged' => $paged);
					$blogPosts = new WP_Query( $args2 ); ?>
					<?php while ( $blogPosts -> have_posts() ) : $blogPosts -> the_post(); 
					$thumb_id = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
					$thumb_url = $thumb_url_array[0]; 
					$image_full = BIGPIX_catch_that_image(); $gallery_full = BIGPIX_catch_gallery_image_full(); ?>
	  						<?php if ( has_post_thumbnail()) : ?>
	  							<li class="item" style="background-image:url('<?php echo esc_url( $thumb_url ); ?>');background-size:cover;background-position:center;">
	  						<?php elseif(has_post_format('image') && !empty($image_full)) :  ?>
	  							<li class="item" style="background-image:url('<?php echo esc_url( $image_full ); ?>');background-size:cover;background-position:center;">
	  						<?php elseif(has_post_format('gallery') && !empty($gallery_full)) : ?>
						    	<li class="item" style="background-image:url('<?php echo esc_url( $gallery_full ); ?>');background-size:cover;background-position:center;">
	  						<?php else : ?>
	  							<li class="item">
	  						<?php endif; ?>
	  						<div class="hover-ovelay">
	  						<div class="wrap">
		  						<?php get_template_part( 'home-post-format/home', get_post_format() ); ?>
							</div>
							</div>
							<div class="bg-overlay-2"></div>
							</li>
	  				<?php endwhile;  ?>
	 				<div class="clear"></div>

			</ul>
			
			<?php  BIGPIX_page_navi(); ?>
			<?php wp_reset_postdata(); ?>
		</div> <!-- content -->
	</div><!-- front-wrapper -->

<?php get_footer(); ?>
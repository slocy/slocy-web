<?php get_header(); ?>

	<div id="content">
		
		<div id="inner-content" class=" cf">

			<?php
			/*
			* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
			* or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
			*/
			$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) :
			if ( $attachment->ID == $post->ID )
			break;
			endforeach;

			?>


			<header class="article-header full-top-area" style="background-image:url('<?php echo wp_get_attachment_url( $attachment->ID); ?>');background-size:cover;background-position:center;position:relative;">

			<div class="bg-overlay"></div>

			</header> <?php // end article header ?>

			<div id="blog" class="divider-posted">
				<p class="byline vcard blog">
				<strong><?php the_title(); ?></strong> <?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'BIGPIX' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))  ); ?>

				</p>
			</div>
				
			<!--<?php get_sidebar(); ?>-->

		</div>

	</div>

<?php get_footer(); ?>
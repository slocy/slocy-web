<?php
	global $multipage;

	// Loop through posts
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
?>
		<article id="<?php the_ID(); ?>" <?php post_class( 'page-content cf' ); ?>>
			<header class="post-header">
				<p class="date"><?php the_time( get_option( 'date_format' ) ); ?></p>

				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
			</header>

			<p>
				<?php
					$metadata = wp_get_attachment_metadata();
					printf( __( '<span class="meta-prep meta-prep-entry-date">Published</span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'simple-shop' ),
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_time( get_option( 'date_format' ) ) ),
							esc_url( wp_get_attachment_url() ),
							$metadata['width'],
							$metadata['height'],
							esc_url( get_permalink( $post->post_parent ) ),
							esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
							get_the_title( $post->post_parent )
					);
				?>
			</p>

			<section class="attachment">
				<?php
				/**
				 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
				 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
				 */
				$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
				foreach ( $attachments as $k => $attachment )
					if ( $attachment->ID == $post->ID )
						break;

				$k++;
				// If there is more than 1 attachment in a gallery
				if ( count( $attachments ) > 1 ) :
					if ( isset( $attachments[ $k ] ) ) :
						// get the URL of the next image attachment
						$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
					else :
						// or get the URL of the first image attachment
						$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
					endif;
				else :
					// or, if there's only 1 image, get the URL of the image
					$next_attachment_url = wp_get_attachment_url();
				endif;
				?>

				<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
					<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>
				</a>

				<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<section class="entry-caption">
						<?php the_content(); ?>
					</section>
				<?php endif; ?>
			</section>

			<?php the_content(); ?>

			<div class="clear"></div>

			<?php edit_post_link( __( 'Edit Post', 'simple-shop' ) ); // Allow logged in users to edit ?>

			<div class="clear"></div>

			<?php sds_single_image_navigation(); ?>

			<section class="clear"></section>

			<?php get_template_part( 'post', 'author' ); // Author Details ?>
		</article>

		<section class="clear"></section>
<?php
		endwhile;
	endif;
?>
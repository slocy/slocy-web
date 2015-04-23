<section id="post-author" class="post-author cf">
	<section class="post-author-inner cf">
		<header class="author-header">
			<figure class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?>
			</figure>

			<h3><?php echo get_the_author_meta( 'display_name' ); ?></h3>
			<a href="<?php echo get_the_author_meta( 'user_url' ); ?>"><?php echo get_the_author_meta( 'user_url' ); ?></a>
		</header>

		<aside class="author-details author-content">

			<p><?php echo get_the_author_meta( 'description' ); ?></p>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php _e( 'View more posts from this author', 'simple-shop' ); ?></a>
		</aside>
	</section>
</section>
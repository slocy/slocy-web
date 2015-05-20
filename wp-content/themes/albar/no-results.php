<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 */
?>
<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php echo __( 'Nothing Found', 'albar' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'albar' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			
		<?php elseif ( is_search() ) : ?>
			
			<p><?php echo kaira_theme_option( 'kra-website-nosearch-msg' ); ?></p>
			
            <div class="not-found-options">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="alba-button"><?php echo __( 'Return Home', 'albar' ); ?></a>
                <a class="alba-button search-button"><?php echo __( 'Search', 'albar' ); ?></a>
            </div>
			
		<?php else : ?>
			
			<p><?php echo kaira_theme_option( 'kra-website-nosearch-msg' ); ?></p>
            
            <div class="not-found-options">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="alba-button"><?php echo __( 'Return Home', 'albar' ); ?></a>
                <a class="alba-button search-button"><?php echo __( 'Search', 'albar' ); ?></a>
            </div>
			
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
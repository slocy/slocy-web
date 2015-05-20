<?php
/**
 * Simple_Shop_Recent_Posts widget class
 * 
 * Extends the WordPress recent posts
 * 
 * @since 4.1.0
 */
class Simple_Shop_Recent_Posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array( 'classname' => 'simple-shop-recent-posts', 'description' => __( 'Your site&#8217;s most recent Posts.', 'simple-shop' ) );
		parent::__construct( 'simple-shop-recent-posts', __( 'Simple Shop Recent Posts', 'simple-shop' ), $widget_ops );
		$this->alt_option_name = 'sds_recent_entries';
		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'simple_shop_widget_recent_posts', 'widget' );
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		ob_start();
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'simple-shop' );
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		//$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );
		if ($r->have_posts()) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<ul>
				<?php while ( $r->have_posts() ) : $r->the_post(); ?>
					<li class="<?php echo ( ! has_post_thumbnail() ) ? 'has-image-placeholder' : false; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ) ?>">
					<?php if ( has_post_thumbnail() ) : ?>
							<figure class="post-thumb">
								<?php the_post_thumbnail( 'simple-shop-800x500' ); ?>
							</figure>
					<?php else: ?>
						<div class="post-image post-image-placeholder">
							<div class="dashicons dashicons-images-alt2"></div>
						</div>
					<?php endif; ?>
							<section class="post-info">
								<h2><?php get_the_title() ? the_title() : the_ID(); ?></h2>
							</section>
						</a>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget']; ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif;
		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'simple_shop_widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? ( bool ) $new_instance['show_date'] : false;
		$this->flush_widget_cache();
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries'] ) )
			delete_option( 'widget_recent_entries' );
		return $instance;
	}
	public function flush_widget_cache() {
		wp_cache_delete( 'simple_shop_widget_recent_posts', 'widget' );
	}
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
	?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'simple-shop' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'simple-shop' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
	<?php
	}
}

/**
 * Register the Slocum Design Studio Recent Posts Widget
 */
function Simple_Shop_Recent_Posts() {
	register_widget( 'Simple_Shop_Recent_Posts' );
}
add_action( 'widgets_init', 'Simple_Shop_Recent_Posts' );
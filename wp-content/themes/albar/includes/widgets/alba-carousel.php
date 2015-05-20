<?php
/**
 * Displays an Albar styled Carousel
 ****************************************************************************************************** */
class alba_carousel extends WP_Widget {
	function __construct() {
		parent::__construct(
			'alba_carousel',
			__( 'Albar Carousel', 'albar' ),
			array(
				'description' => __( 'Displays Posts in a Carousel Style', 'albar' ),
			)
		);
	}

	function widget( $args, $instance ) {
        
        if ( $instance['category'] ) {
            $carousel_cats = 'cat=' . $instance['category'] . '&';
        }
        
        $query = new WP_Query( $carousel_cats . 'posts_per_page=-1' );
        
		$output = '';
		$output .= $args['before_widget'];
		$output .= $args['before_title'];
			
$output .= '<div class="alba-carousel-wrapper columns-' . esc_attr( $instance['columns'] ) . ' alba-carousel-remove-load" data-columns="' . esc_attr( $instance['columns'] ) . '">
				<div class="alba-carousel-arrow-prev"><i class="fa fa-angle-left"></i></div>
				<div class="alba-carousel-arrow-next"><i class="fa fa-angle-right"></i></div>
				
				<div id="" class="alba-carousel alba-carousel-remove">';
				
                    while ( $query->have_posts() ) : $query->the_post();
                        $carouselimage = get_the_post_thumbnail( get_the_ID(), 'blog_standard_img' );
                    
        	$output .= '<div class="alba-carousel-block">';
            
        				if ( $instance['show-featured-image'] == 'on' ) :
                            
        		$output .= '<div class="alba-carousel-block-img">';
        				
        				$output .= '<a href="' . get_permalink() . '"></a>';
                        
        				$output .= $carouselimage;
        			$output .= '</div>';
        						
                        endif;
        				
                        if( $instance['show-title'] == 'on' ) :
        		
                $output .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
        				
                        endif;
        				
                        if( $instance['show-meta'] == 'on' ) :
        		
                $output .= '<div class="alba-carousel-block-meta">';
        						
                            if ( 'post' == get_post_type() ) :
                    $output .= '<i class="fa fa-calendar"></i> ' . get_the_date();
                            endif;
                            
                            //if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
                    $output .= '<span class="comments-link"><i class="fa fa-comments"></i>' . get_comments_number( __( '0', 'kaira' ), __( '1', 'kaira' ), __( '%', 'kaira' ) ) . '</span>';
                            //endif;
                                
        		$output .= '</div>';
        				endif;
        						
                        if($instance['show-excerpt'] == 'on') :
                            
                            if ( get_the_excerpt() > $instance['excerpt-length'] ) :
                    $output .= '<p>' . substr( strip_tags( get_the_excerpt() ), 0, $instance['excerpt-length'] )."</p>";
                            else:
            		$output .= '<p>' . get_the_excerpt() . '</p>';
                            endif;
                        		
                        endif;
        	$output .= '</div>';
					
				    endwhile;
					
	$output .= '</div>';
				if($instance['carousel-pagination'] == 'numbers') :
	$output .= '<div class="alba-carousel-pagination alba-numbers-pagination"></div>';
				elseif ($instance['carousel-pagination'] == 'dots') :
    $output .= '<div class="alba-carousel-pagination alba-dots-pagination"></div>';
                endif;
    $output .= '<div class="clearboth"></div>';
$output .= '</div>';
			
			$output .= $args['after_title'];
		$output .= $args['after_widget'];
		
		echo $output;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'category' => '',
			'columns' => '4',
			'show-featured-image' => 'on',
			'show-title' => 'on',
			'show-excerpt' => 'on',
            'excerpt-length' => 200,
			'show-meta' => 'on',
			'carousel-pagination' => 'dots'
		) ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ) ?>"><?php echo __( 'Category', 'albar' ) ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'category' ) ?>" id="<?php echo $this->get_field_id( 'category' ) ?>" value="<?php echo esc_attr( $instance['category'] ) ?>" />
            <span class="widgets-desc"><?php echo __( 'Enter the ID\'s of the <a href="' . admin_url( 'edit-tags.php?taxonomy=category' ) . '" target="_blank">post categories</a> you want to show in this carousel. Eg: "4,6,8". Or leave blank to show ALL posts.', 'albar' ) ?></span>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'columns' ) ?>"><?php echo __( 'Columns', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'columns' ) ?>" id="<?php echo $this->get_field_id( 'columns' ) ?>">
				<option value="1" <?php selected( $instance['columns'], '1' ) ?>><?php esc_html_e( '1', 'albar' ) ?></option>
				<option value="2" <?php selected( $instance['columns'], '2' ) ?>><?php esc_html_e( '2', 'albar' ) ?></option>
				<option value="3" <?php selected( $instance['columns'], '3' ) ?>><?php esc_html_e( '3', 'albar' ) ?></option>
				<option value="4" <?php selected( $instance['columns'], '4' ) ?>><?php esc_html_e( '4', 'albar' ) ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show-featured-image' ) ?>"><?php echo __( 'Show Featured Image', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'show-featured-image' ) ?>" id="<?php echo $this->get_field_id( 'show-titfeatured-imagele' ) ?>">
				<option value="on" <?php selected( $instance['show-featured-image'], 'on' ) ?>><?php esc_html_e( 'On', 'albar' ) ?></option>
				<option value="off" <?php selected( $instance['show-featured-image'], 'off' ) ?>><?php esc_html_e( 'Off', 'albar' ) ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show-title' ) ?>"><?php echo __( 'Show Title', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'show-title' ) ?>" id="<?php echo $this->get_field_id( 'show-title' ) ?>">
				<option value="on" <?php selected( $instance['show-title'], 'on' ) ?>><?php esc_html_e( 'On', 'albar' ) ?></option>
				<option value="off" <?php selected( $instance['show-title'], 'off' ) ?>><?php esc_html_e( 'Off', 'albar' ) ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show-excerpt' ) ?>"><?php echo __( 'Show Post Excerpt', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'show-excerpt' ) ?>" id="<?php echo $this->get_field_id( 'show-excerpt' ) ?>">
				<option value="on" <?php selected( $instance['show-excerpt'], 'on' ) ?>><?php esc_html_e( 'On', 'albar' ) ?></option>
				<option value="off" <?php selected( $instance['show-excerpt'], 'off' ) ?>><?php esc_html_e( 'Off', 'albar' ) ?></option>
			</select>
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ) ?>"><?php echo __( 'Excerpt Length', 'albar' ) ?></label>
            <input type="number" class="widefat" name="<?php echo $this->get_field_name( 'excerpt-length' ) ?>" id="<?php echo $this->get_field_id( 'excerpt-length' ) ?>" value="<?php echo esc_attr( $instance['excerpt-length'] ) ?>" />
            <span class="widgets-desc"><?php echo __( 'Enter the character length you want the excerpt to be. Default is 200 characters.', 'albar' ) ?></span>
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'show-meta' ) ?>"><?php echo __( 'Show Post Meta', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'show-meta' ) ?>" id="<?php echo $this->get_field_id( 'show-meta' ) ?>">
				<option value="on" <?php selected( $instance['show-meta'], 'on' ) ?>><?php esc_html_e( 'On', 'albar' ) ?></option>
				<option value="off" <?php selected( $instance['show-meta'], 'off' ) ?>><?php esc_html_e( 'Off', 'albar' ) ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'carousel-pagination' ) ?>"><?php echo __( 'Carousel Pagination', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'carousel-pagination' ) ?>" id="<?php echo $this->get_field_id( 'carousel-pagination' ) ?>">
				<option value="numbers" <?php selected( $instance['carousel-pagination'], 'numbers' ) ?>><?php esc_html_e( 'Numbers', 'albar' ) ?></option>
				<option value="dots" <?php selected( $instance['carousel-pagination'], 'dots' ) ?>><?php esc_html_e( 'Dots', 'albar' ) ?></option>
                <option value="none" <?php selected( $instance['carousel-pagination'], 'none' ) ?>><?php esc_html_e( 'None', 'albar' ) ?></option>
			</select>
		</p>
	<?php
	}
} ?>
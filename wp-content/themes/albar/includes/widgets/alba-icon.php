<?php

/**
 * Displays an Albar Icon
 ****************************************************************************************************** */
class alba_icon extends WP_Widget {
	function __construct() {
		parent::__construct(
			'alba_icon',
			__( 'Albar Icon', 'albar' ),
			array(
				'description' => __( 'Displays a Font Awesome Icon of your choice.', 'albar' ),
			)
		);
	}

	function widget( $args, $instance ) {
		if ( empty( $instance['icon_name'] ) ) return;
		
		$output = '';
		$output .= $args['before_widget'];
		$output .= $args['before_title'];
		
		$output .= '<div class="alba-icon alba-icon-size-' . $instance['icon_size'] . ' alba-icon-style-' . $instance['icon_style'] . ' alba-icon-align-' . $instance['icon_align'] . '">';
            $output .= '<div class="alba-icon-inner" style="background-color: ' . $instance['icon_bg_color'] . '; color: ' . $instance['icon_color'] . '; font-size: ' . $instance['icon_size'] . 'px;">';
		
			    $output .= '<i class="fa ' . $instance['icon_name'] . '"></i>';
                
            $output .= '</div>';
		$output .= '</div>';
		$output .= $args['after_title'];
		$output .= $args['after_widget'];
		
		echo $output;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'icon_name' => 'fa-home',
            'icon_bg_color' => 'transparent',
            'icon_color' => '#000000',
            'icon_size' => '20',
            'icon_style' => 'round',
            'icon_align' => 'center'
		) );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_name' ) ?>"><?php echo __( 'Icon Name', 'albar' ) ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'icon_name' ) ?>" id="<?php echo $this->get_field_id( 'icon_name' ) ?>" value="<?php echo esc_attr( $instance['icon_name'] ) ?>" />
            <span class="widgets-desc"><?php echo __( 'Select the icon from <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Font Awesome</a>, select the text name and add it here. Eg: "fa-glass".', 'albar' ) ?></span>
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'icon_bg_color' ) ?>"><?php echo __( 'Icon Background Color', 'albar' ) ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'icon_bg_color' ) ?>" id="<?php echo $this->get_field_id( 'icon_bg_color' ) ?>" value="<?php echo esc_attr( $instance['icon_bg_color'] ) ?>" />
            <span class="widgets-desc"><?php echo __( 'Enter the hash value for the background color of the icon. Eg: "#000000" (Include the "#"")', 'albar' ) ?></span>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'icon_color' ) ?>"><?php echo __( 'Icon Color', 'albar' ) ?></label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'icon_color' ) ?>" id="<?php echo $this->get_field_id( 'icon_color' ) ?>" value="<?php echo esc_attr( $instance['icon_color'] ) ?>" />
            <span class="widgets-desc"><?php echo __( 'Enter the hash value for the color of the icon. Eg: "#000000" (Include the "#"")', 'albar' ) ?></span>
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ) ?>"><?php echo __( 'Icon Size', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'icon_size' ) ?>" id="<?php echo $this->get_field_id( 'icon_size' ) ?>">
				<option value="18" <?php selected( $instance['icon_size'], '18' ) ?>><?php esc_html_e( '18px', 'albar' ) ?></option>
				<option value="26" <?php selected( $instance['icon_size'], '26' ) ?>><?php esc_html_e( '26px', 'albar' ) ?></option>
                <option value="34" <?php selected( $instance['icon_size'], '34' ) ?>><?php esc_html_e( '34px', 'albar' ) ?></option>
                <option value="48" <?php selected( $instance['icon_size'], '48' ) ?>><?php esc_html_e( '48px', 'albar' ) ?></option>
                <option value="66" <?php selected( $instance['icon_size'], '66' ) ?>><?php esc_html_e( '66px', 'albar' ) ?></option>
                <option value="86" <?php selected( $instance['icon_size'], '86' ) ?>><?php esc_html_e( '86px', 'albar' ) ?></option>
                <option value="100" <?php selected( $instance['icon_size'], '100' ) ?>><?php esc_html_e( '100px', 'albar' ) ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_style' ) ?>"><?php echo __( 'Icon Style', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'icon_style' ) ?>" id="<?php echo $this->get_field_id( 'icon_style' ) ?>">
                <option value="none" <?php selected( $instance['icon_style'], 'none' ) ?>><?php esc_html_e( 'None', 'albar' ) ?></option>
				<option value="round" <?php selected( $instance['icon_style'], 'round' ) ?>><?php esc_html_e( 'Round', 'albar' ) ?></option>
				<option value="square" <?php selected( $instance['icon_style'], 'square' ) ?>><?php esc_html_e( 'Square', 'albar' ) ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_align' ) ?>"><?php echo __( 'Icon Alignment', 'albar' ) ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name( 'icon_align' ) ?>" id="<?php echo $this->get_field_id( 'icon_align' ) ?>">
				<option value="left" <?php selected( $instance['icon_align'], 'left' ) ?>><?php esc_html_e( 'Left', 'albar' ) ?></option>
				<option value="center" <?php selected( $instance['icon_align'], 'center' ) ?>><?php esc_html_e( 'Center', 'albar' ) ?></option>
				<option value="right" <?php selected( $instance['icon_align'], 'right' ) ?>><?php esc_html_e( 'Right', 'albar' ) ?></option>
			</select>
		</p>
		<?php
	}
} ?>
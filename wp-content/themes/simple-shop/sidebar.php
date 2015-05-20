<?php
	global $sds_theme_options;

	// Primary Sidebar
	if ( isset( $sds_theme_options['body_class'] ) && ( ! empty( $sds_theme_options['body_class'] ) && $sds_theme_options['body_class'] !== 'cols-1' ) ) :
?>
		<!-- Page Sidebar-->
		<aside class="sidebar <?php echo ( is_active_sidebar( 'primary-sidebar' ) ) ? 'widgets' : 'no-widgets'; ?>">
			<?php sds_primary_sidebar(); ?>
		</aside>
<?php
	endif;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html><!--<![endif]-->
	<head>
		<?php wp_head(); ?>
	</head>

	<body <?php language_attributes(); ?> <?php body_class(); ?>>

		<!-- Header	-->
		<header id="header" class="cf">
			<!-- Top Nav -->
			<nav class="top-nav">
				<?php
					wp_nav_menu( array(
						 'theme_location' => 'top_nav',
						 'container'      => false,
						 'menu_class'     => 'top-nav',
						 'menu_id'        => 'top-nav',
						 'depth'          => 0
					 ) );
				?>
			</nav>
			<!--  Logo 	-->
			<section class="logo-box">
				<?php sds_logo(); ?>
				<?php sds_tagline(); ?>
			</section>

			<!-- Primary Navigation -->
			<nav class="primary-nav-container">
				<a href="#" class="primary-nav-button" title="<?php esc_attr_e( 'Toggle Navigation', 'simple-shop' ); ?>">
					<?php _e( 'Navigation', 'simple-shop' ) ?>
				</a>
				<?php
					wp_nav_menu( array(
						 'theme_location' => 'primary_nav',
						 'container'      => false,
						 'menu_class'     => 'primary-nav menu',
						 'menu_id'        => 'primary-nav',
						 'fallback_cb'    => 'sds_primary_menu_fallback'
					 ) );
				?>
			</nav>
		</header>
		<div class="clear"></div>
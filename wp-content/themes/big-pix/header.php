<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php if ( get_theme_mod( 'BIGPIX_favicon' ) ) : ?>
		<link rel="icon" href="<?php echo esc_url( get_theme_mod( 'BIGPIX_favicon' ) ); ?>">
		<?php endif; ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?> >

		<div id="container">

			<header class="header" role="banner">
				<div id="inner-header" class="wrap cf">
					<?php if ( get_theme_mod( 'BIGPIX_logo' ) ) : ?>
					<p id="logo" class="h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="nofollow" style="width:300px;margin:0 auto;display:block;"><img src="<?php echo esc_url( get_theme_mod( 'BIGPIX_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a></p>
					 <?php else : ?>
					<p id="logo" class="h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
					<?php endif; ?>
					<div id="main-navigation">
			            <div id="close"><span class="fa fa-times"></span> Close</div>
			            <div class="clear"></div>
			            <!-- social icons -->
				        <div class="social-icons">
				            <?php 
					           	if(function_exists('BIGPIX_social_icons')) :
					           		echo BIGPIX_social_icons(); 
					           	endif;
					        ?>
	                	</div>
	                	<!-- social icons -->

			            <?php if ( is_active_sidebar( 'sidebar3' ) && is_front_page() ) : ?>

						<?php dynamic_sidebar( 'sidebar3' ); ?>

						<?php elseif ( is_active_sidebar( 'sidebar1' ) && is_single() ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

						<?php elseif ( is_active_sidebar( 'sidebar2' ) && is_page() ) : ?>

						<?php dynamic_sidebar( 'sidebar2' ); ?>

						<?php elseif ( is_active_sidebar( 'sidebar5' ) && is_archive() || is_search()) : ?>

						<?php dynamic_sidebar( 'sidebar5' ); ?>

						<?php else: ?>

						<?php
							/*
							 * This content shows up if there are no widgets defined in the backend.
							*/
						?>

						<div class="no-menu-widgets">
							<p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'BIGPIX' );  ?></p>
						</div>

					<?php endif; ?>
						<div class="margin-bottom"></div>
        			</div>
					<div class="side-nav" id="push"><span class="fa fa-bars"></span></div>

				</div>

			</header>
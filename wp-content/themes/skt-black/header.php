<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package SKT Black
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( (of_get_option('innerpageslider', true) != 'hide') || is_home() || is_front_page() ) { ?>
	<div class="slider-main">
	<?php if( of_get_option( 'header_title', true ) != '' ) { ; ?>
            <div class="top-bar">
                <?php echo of_get_option( 'header_title', true ); ?>
            </div><!-- top-bar -->
            <a href="<?php echo esc_url(get_site_url().'/#services'); ?>" class="arrow-down"></a>
        <?php } ?>
        
    <div id="slider" class="nivoSlider">
       <?php
		   	if ( of_get_option('slide1', true) == 1 ){
					echo  "<h1 style='position:relative;top:350px;left:20%'>".__('Go to Appearance > Theme Options > Restore Defaults to setup the homepage','skt-black')."</h1>";
				}
				
			
			for ($i=1; $i<6; $i++) {
				if ( of_get_option('slide'.$i, true) != "" ) { ?>
                <img src="<?php echo esc_url(of_get_option('slide'.$i,true)); ?>" />
				<?php		
				}
			}
               ?>
    </div><!-- slider -->
    </div><!-- slider-main -->
<?php } ?>

<div class="header">
            		<div class="header-inner">
                    		<div class="logo">
                            		<a href="<?php echo esc_url( home_url('/')); ?>">
                                    	<?php if( of_get_option( 'logo', true ) != '' ) { ; ?>
 	                                       <img src="<?php echo esc_url( of_get_option( 'logo', true )); ?>" / >
                                        <?php } else { ?>
    	                                    <h2><?php bloginfo('name'); ?></h2>
                                        <?php } ?>
                                    </a>
                             </div><!-- logo -->
                            <div class="toggle">
                            <a class="toggleMenu" href="#"><?php _e('Menu','skt-black'); ?></a>
                            </div><!-- toggle -->
                            <div class="nav">
								<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
                            </div><!-- nav --><div class="clear"></div>
                    </div><!-- header-inner -->
            </div><!-- header -->
      <div class="main-container">
         <?php if( function_exists('is_woocommerce') && is_woocommerce() ) { ?>
		 	<div class="content-area">
                <div class="middle-align content_sidebar">
                	<div id="sitemain" class="site-main">
         <?php } ?>
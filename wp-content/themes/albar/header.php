<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale = 1.0, user-scalable=0" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( kaira_theme_option( 'kra-favicon' ) ) :
    echo '<link rel="icon" href="' . esc_url( kaira_theme_option( 'kra-favicon' ) ) . '">';
endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<?php if ( kaira_theme_option( 'kra-website-layout' ) == 'site-layout-boxed' ) : ?>
<div class="site-boxed">
<?php endif; ?>


<?php get_template_part( '/includes/headers/header-layout-one' ); ?>

<?php if ( is_front_page() ) : ?>
    
    <?php if ( kaira_theme_option( 'kra-enable-home-slider' ) == 1 ) : ?>
    
        <?php get_template_part( '/includes/headers/homepage-slider' ); ?>
        
    <?php endif; ?>
    
<?php endif; ?>
<?php if ( !is_front_page() ) : ?>
    
    <header class="entry-header">
        
        <?php if ( is_home() ) : ?>
            
            <?php echo ( get_theme_mod( 'topshop-blog-title' ) ) ? '<h1 class="entry-title">' . esc_html( get_theme_mod( 'topshop-blog-title', false ) ) . '</h1>' : '<h1 class="entry-title">' . __( 'Blog', 'topshop' ) . '</h1>'; ?>
            
        <?php else: ?>
            
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            
        <?php endif; ?>
        
    </header><!-- .entry-header -->

<?php endif; ?>
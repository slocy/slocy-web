<?php if ( !is_front_page() ) : ?>
	
    <div class="page-header">
        <div class="site-container">
            <h1>
                <?php if ( is_home() ) : ?>
                    
                    <?php echo kaira_theme_option( 'kra-blog-title' ); ?>
                    
                <?php else: ?>
                    
                    <?php the_title(); ?>
                    
                <?php endif; ?>
            </h1>
            <div class="cx-breadcrumbs">
                <?php if ( function_exists( 'bcn_display' ) ) : ?>
                    <?php bcn_display(); ?>
                <?php else: ?>
                    
                <?php endif; ?>
            </div>
            <div class="clearboth"></div>
        </div>
    </div>
    
<?php endif; ?>
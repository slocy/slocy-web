<?php
$slider_cats = kaira_theme_option( 'kra-slider-categories' );

if( $slider_cats ) :

    $slider_query = new WP_Query( 'cat=' . $slider_cats . '&posts_per_page=-1&orderby=date&order=DESC' ); ?>

    <?php if ( $slider_query->have_posts() ) : ?>

        <div id="alba-home-slider-wrapper" class="alba-slider alba-home-slider-remove"<?php echo ( kaira_theme_option( 'kra-slider-auto-scroll' ) ) ? ' data-auto="4000"' : ' data-auto="false"'; ?><?php echo ( kaira_theme_option( 'kra-circular-slider' ) ) ? ' data-circular="true"' : ' data-circular="false"'; ?><?php echo ( kaira_theme_option( 'kra-infinite-slider' ) ) ? ' data-infinite="true"' : ' data-infinite="false"'; ?>>
            <div id="alba-home-slider-prev"><i class="fa fa-angle-left"></i></div>
            <div id="alba-home-slider-next"><i class="fa fa-angle-right"></i></div>
            
            <div id="alba-home-slider">
                
                <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                
                    <div>
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                        
                            <?php the_post_thumbnail( 'full', array( 'class' => '' ) ); ?>
                            
                        <?php endif; ?>
                        
                        <h3>
                            <?php if ( kaira_theme_option( 'kra-slider-links' ) ) : ?>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php else: ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h3>
                        
                    </div>
                
                <?php endwhile; ?>
                
            </div>
            <?php if ( kaira_theme_option( 'kra-enable-slider-pagination' ) ) : ?>
            <div id="alba-home-slider-pager"></div>
            <?php endif; ?>
        </div>
        
    <?php endif; wp_reset_query(); ?>

<?php else: ?>
    
    <div id="alba-home-slider-wrapper" class="alba-slider alba-home-slider-remove" data-auto="4000" data-circular="true" data-infinite="true">
        <div id="alba-home-slider-prev"><i class="fa fa-angle-left"></i></div>
        <div id="alba-home-slider-next"><i class="fa fa-angle-right"></i></div>
        
        <div id="alba-home-slider">
                
                <div>
                    
                    <img src="<?php echo get_template_directory_uri() ?>/images/demo/dummy_img_01.jpg" alt="<?php esc_attr_e('Demo Slide One', 'albar') ?>" />
                    
                    <h3>
                        Demo Slide One
                    </h3>
                    
                </div>
                
                <div>
                    
                    <img src="<?php echo get_template_directory_uri() ?>/images/demo/dummy_img_02.jpg" alt="<?php esc_attr_e('Demo Slide Two', 'albar') ?>" />
                    
                    <h3>
                        Demo Slide Two
                    </h3>
                    
                </div>
            
        </div>
        <div id="alba-home-slider-pager"></div>
    </div>

<?php endif; ?>
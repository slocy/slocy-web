<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package albar
 */ ?>
	
	<?php do_action( 'before_sidebar' ); ?>
    <div id="secondary" class="widget-area" role="complementary">
        
        <?php if ( is_page_template( 'template-right-nav-sidebar.php' ) ) : ?>
            
            <?php
            $child_pages = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
            if ( $child_pages ) : ?>
            <div class="sidebar-navigation sidebar-navigation-right">
                <?php echo '<ul>' . $child_pages . '</ul>'; ?>
            </div>
            <?php endif; ?>
            
        <?php elseif ( is_page_template( 'template-left-nav-sidebar.php' ) ): ?>
        
            <?php
            $child_pages = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
            if ( $child_pages ) : ?>
            <div class="sidebar-navigation sidebar-navigation-left">
                <?php echo '<ul>' . $child_pages . '</ul>'; ?>
            </div>
            <?php endif; ?>
            
        <?php endif; ?>
        
    	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
    		
    		<aside id="search" class="widget widget_search">
    			<?php get_search_form(); ?>
    		</aside>
    		
    		<aside id="archives" class="widget">
    			<h1 class="widget-title"><?php _e( 'Archives', 'albar' ); ?></h1>
    			<ul>
    				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
    			</ul>
    		</aside>
    		
    		<aside id="meta" class="widget">
    			<h1 class="widget-title"><?php _e( 'Meta', 'albar' ); ?></h1>
    			<ul>
    				<?php wp_register(); ?>
    				<li><?php wp_loginout(); ?></li>
    				<?php wp_meta(); ?>
    			</ul>
    		</aside>
        
    	<?php endif; // end sidebar widget area ?>
    
    </div>
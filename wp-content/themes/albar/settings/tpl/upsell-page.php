<?php
/**
 * The UpSell page included on the admin settings page
 *
 * @package albar
 */ ?>

<div class="premium-upsell-wrap">
    
    <h4>
        <?php echo __( '<a href="http://sllwi.re/p/Eu" target="_blank">Upgrade to Albar Premium</a> to get all the features for the Albar theme.', 'albar' ); ?>
    </h4>
    
    <div class="premium-albar-wrap">
        
        <div class="premium-albar-block">
            <div class="premium-albar-block-left">
                <h6><?php echo __( 'Header Layout', 'albar' ); ?></h6>
                <span class="description">
                    <?php echo __( 'Have the option to select between 2 different header layouts.', 'albar' ); ?>
                </span>
            </div>
            <div class="premium-albar-block-right">
                <img src="<?php echo get_template_directory_uri(); ?>/settings/images/albar-header-one.jpg" alt="Albar header layout one" /><br /><br />
                <img src="<?php echo get_template_directory_uri(); ?>/settings/images/albar-header-two.jpg" alt="Albar header layout two" />
            </div>
            <div class="clearboth"></div>
        </div>
        
        <div class="premium-albar-block">
            <div class="premium-albar-block-left">
                <h6><?php echo __( 'Sticky Header', 'albar' ); ?></h6>
                <span class="description">
                    <?php echo __( 'Upgrade to enable the sticky header option that keeps the header at the top of the browser and re-sizes to be smaller.', 'albar' ); ?>
                </span>
            </div>
            <div class="premium-albar-block-right">
                <img src="<?php echo get_template_directory_uri(); ?>/settings/images/albar-sticky-header.jpg" alt="Albar sticky header" />
            </div>
            <div class="clearboth"></div>
        </div>
        
        <div class="premium-albar-block">
            <div class="premium-albar-block-left">
                <h6><?php echo __( 'Slider Transitions', 'albar' ); ?></h6>
                <span class="description">
                    <?php echo __( 'Enable the options to change the transition effect on the home page slider.', 'albar' ); ?>
                </span>
            </div>
            <div class="premium-albar-block-right">
                <img src="<?php echo get_template_directory_uri(); ?>/settings/images/albar-slider-transitions.jpg" alt="Albar slider transitions" />
            </div>
            <div class="clearboth"></div>
        </div>
        
        <div class="premium-albar-block">
            <div class="premium-albar-block-left">
                <h6><?php echo __( 'Blog Layout', 'albar' ); ?></h6>
                <span class="description">
                    <?php echo __( 'Select between 2 different blog layouts, standard and grid', 'albar' ); ?>
                </span>
            </div>
            <div class="premium-albar-block-right">
                <img src="<?php echo get_template_directory_uri(); ?>/settings/images/albar-blog-layout.jpg" alt="Albar blog layout" />
            </div>
            <div class="clearboth"></div>
        </div>
        
        <div class="premium-albar-block">
            <div class="premium-albar-block-left">
                <h6><?php echo __( 'Extra WooCommerce Styling', 'albar' ); ?></h6>
                <span class="description">
                    <?php echo __( 'Premium version includes some extra WooCommerce styling', 'albar' ); ?>
                </span>
            </div>
            <div class="premium-albar-block-right">
                <img src="<?php echo get_template_directory_uri(); ?>/settings/images/albar-woocommerce-styling.jpg" alt="Albar WooCommerce Styling" />
            </div>
            <div class="clearboth"></div>
        </div>
        
        <div class="clearboth"></div>
    </div>
    
    <div class="clearboth"></div>
</div>
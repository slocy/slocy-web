<?php
if( kaira_theme_option( 'kra-social-email' ) ) :
    echo '<a href="' . esc_url( 'mailto:' . antispambot( kaira_theme_option( 'kra-social-email' ), 1 ) ) . '" title="' . __( 'Send Us an Email', 'albar' ) . '"><i class="fa fa-envelope-o"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-skype' ) ) :
    echo '<a href="skype:' . esc_html( kaira_theme_option( 'kra-social-skype' ) ) . '?userinfo" title="' . __( 'Contact Us on Skype', 'albar' ) . '"><i class="fa fa-skype"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-facebook' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-facebook' ) ) . '" target="_blank" title="' . __( 'Find Us on Facebook', 'albar' ) . '"><i class="fa fa-facebook"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-twitter' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-twitter' ) ) . '" target="_blank" title="' . __( 'Follow Us on Twitter', 'albar' ) . '"><i class="fa fa-twitter"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-google-plus' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-google-plus' ) ) . '" target="_blank" title="' . __( 'Find Us on Google Plus', 'albar' ) . '"><i class="fa fa-google-plus"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-youtube' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-youtube' ) ) . '" target="_blank" title="' . __( 'View our YouTube Channel', 'albar' ) . '"><i class="fa fa-youtube"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-instagram' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-instagram' ) ) . '" target="_blank" title="' . __( 'Follow Us on Instagram', 'albar' ) . '"><i class="fa fa-instagram"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-pinterest' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-pinterest' ) ) . '" target="_blank" title="' . __( 'Pin Us on Pinterest', 'albar' ) . '"><i class="fa fa-pinterest"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-linkedin' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-linkedin' ) ) . '" target="_blank" title="' . __( 'Find Us on LinkedIn', 'albar' ) . '"><i class="fa fa-linkedin"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-tumblr' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-tumblr' ) ) . '" target="_blank" title="' . __( 'Find Us on Tumblr', 'albar' ) . '"><i class="fa fa-tumblr"></i></a>';
endif;

if( kaira_theme_option( 'kra-social-flickr' ) ) :
    echo '<a href="' . esc_url( kaira_theme_option( 'kra-social-flickr' ) ) . '" target="_blank" title="' . __( 'Find Us on Flickr', 'albar' ) . '"><i class="fa fa-flickr"></i></a>';
endif; ?>
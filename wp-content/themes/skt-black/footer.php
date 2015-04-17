<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Black
 */
?>

<?php if( is_home() || is_front_page() ) { ?>
<section style="background-color:#000000; ">
            	<div class="container"><h2><?php if(of_get_option('socialtitle',true) != ''){ echo of_get_option('socialtitle',true);}; ?></h2>
                		<div class="social-icons">
                	<?php if( of_get_option('facebook',true) !=  ''){ ?>
                		<a href="<?php echo esc_url(of_get_option('facebook',true)); ?>" title="Facebook"><div class="facebook icon"></div><!-- fb-icon --></a>
                    <?php } ?>
                    <?php if( of_get_option('twitter',true) != '') { ?>
                        <a href="<?php echo esc_url(of_get_option('twitter',true)); ?>" title="Twitter"><div class="twitt icon"></div><!-- twitt --></a>
                    <?php } ?>
                    <?php if( of_get_option('gplus',true) != ''){ ?>
                        <a href="<?php echo esc_url(of_get_option('gplus',true)); ?>" title="Google +"><div class="gplus icon"></div><!-- gplus --></a>
                   	<?php } ?>
                    <?php if( of_get_option('linkedin',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('linkedin',true)); ?>" title="Linkedin"><div class="linked icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('pint',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('pint')); ?>" title="Pinterest"><div class="pinterest icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('youtube',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('youtube',true)); ?>" title="YouTube"><div class="youtube icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('vimeo',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('vimeo',true)); ?>" title="Vimeo"><div class="vimeo icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('rss',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('rss')); ?>" title="RSS"><div class="rss icon"></div></a>
                    <?php } ?>
                    <?php if( of_get_option('insta',true) != ''){ ?>
                    	<a href="<?php echo esc_url(of_get_option('insta',true)); ?>" title="Instagram"><div class="instagram icon"></div></a>
                    <?php } ?>
                    </div><!-- social-icons -->
                </div><!-- container --> 
</section>
<?php } ?>
 <div id="footer-wrapper">
    	<footer class="footer">
        	<div class="footer-col-1">
            	<h2><?php if( of_get_option('footerabttitle',true) != '') { echo of_get_option('footerabttitle'); }; ?></h2>
                <p><?php if( of_get_option('footerabttext') != ''){ echo esc_html(of_get_option('footerabttext'));}; ?></p>
            </div>
            
            <div class="footer-col-1">
            	<h2><?php if( of_get_option('recenttitle') != ''){ echo of_get_option('recenttitle');}; ?></h2>
                <ul class="recent-post">
                	<?php query_posts('post_type=post&showposts=2'); ?>
                    <?php  while( have_posts() ) : the_post(); ?>
                  	<li><a href="<?php esc_url(the_permalink()); ?>"><?php get_the_post_thumbnail( get_the_ID(), array(67,49) ); ?><?php the_excerpt(); ?><br />
                    <span><?php _e('Read more...','skt-black'); ?></span></a></li>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </ul>
            </div>
            
            <div class="footer-col-3">
            	<h2><?php if( of_get_option('addresstitle') != '') { echo of_get_option('addresstitle'); } ; ?></h2>
                <p><?php if( of_get_option('address',true) != '') { echo of_get_option('address',true) ; } ; ?></p>
                <div class="phone-no">
                	<p><strong><?php _e('Phone:','skt-black'); ?></strong><?php if( of_get_option('phone',true) != ''){ echo of_get_option('phone'); }; ?></p>
                    <p><strong><?php _e('E-mail:','skt-black'); ?></strong><a href="mailto:<?php echo of_get_option('email',true); ?>"><?php if( of_get_option('email',true) != '' ) { echo of_get_option('email',true) ; }; ?></a></p>
                    <p><strong><?php _e('Website:','skt-black'); ?></strong><a href="http://<?php echo esc_url(of_get_option('weblink',true)); ?>" target="_blank"><?php if( of_get_option('weblink',true) != ''){echo of_get_option('weblink',true); }; ?></a></p>
                </div>
            </div>
            <div class="clear"></div>
        </footer>
        
        <div class="copyright-wrapper">
        	<div class="copyright">
            	<div class="copyright-txt"><?php if( of_get_option('copytext',true) != ''){ echo of_get_option('copytext',true); }; ?></div>
                <div class="design-by"><a href="<?php echo esc_url(SKT_SITE_URL); ?>"><?php if( of_get_option('ftlink', true) != ''){echo of_get_option('ftlink',true);}; ?></a></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
  
<?php wp_footer(); ?>

</body>
</html>
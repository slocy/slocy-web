<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package topshop
 */
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	
    <div class="site-footer-widgets">
        <div class="site-container">
            <ul>
                <?php dynamic_sidebar( 'topshop-site-footer' ); ?>
            </ul>
            <div class="clearboth"></div>
        
			<?php printf( __( '</div></div><div class="site-footer-bottom-bar"><div class="site-container"><div class="site-footer-bottom-bar-left"><a href="mailto:slocyweb@gmail.com">Contact Customer Service</a></div><div class="site-footer-bottom-bar-right">' ) ); ?>
            
            <?php _e( '&copy; 2015', 'Slocy.com' ); ?><a href="<?php echo esc_url( __( 'https://slocy.com/', 'Slocy.com' ) ); ?>"><?php printf( __( '%s', 'Slocy.com' ), 'Slocy.com' ); ?></a>
                
	        </div>
	    </div>
		
        <div class="clearboth"></div>
	</div>
	
</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>
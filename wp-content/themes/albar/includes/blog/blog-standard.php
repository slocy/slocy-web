<?php
$blog_cats_set = '';
if ( kaira_theme_option( 'kra-blog-excl-categories' ) ) {
    $blog_cats_set = 'cat=' . kaira_theme_option( 'kra-blog-excl-categories' ) . '&';
}
$blog_posts_per_page = kaira_theme_option( 'kra-blog-ppp' );
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$blog_query = new WP_Query( $blog_cats_set . 'posts_per_page=' . $blog_posts_per_page . '&paged=' . $paged );

if ( $blog_query->have_posts() ) : ?>
    
    <div class="blog-list-wrap">
    
        <?php
        while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'alba-blog-standard-block ' ); ?>>
                
                <?php
                $images = get_posts( array("numberposts"=>-1,"post_type"=>"attachment","post_mime_type"=>"image","orderby" => "menu_order", "order" => "ASC","post_parent"=>$post->ID) );
                if ( $images ) : ?>
                <div class="alba-blog-standard-block-imgs">
                    
                    <div class="alba-blog-standard-block-img-carousel-wrapper alba-blog-standard-block-img-wrapper-remove">
                        <div class="alba-blog-standard-block-img-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="alba-blog-standard-block-img-next"><i class="fa fa-angle-right"></i></div>
                        
                        <div class="alba-blog-standard-block-img-carousel alba-blog-standard-block-img-remove">
                            
                            <?php
                            foreach ( $images as $image ) {
                                $title = $image->post_title;
                                $thumbimage = wp_get_attachment_image_src( $image->ID, "blog_standard_img" ); ?>
                                <img src="<?php echo $thumbimage[0]; ?>" alt="<?php echo esc_html( $title ) ?>" />
                            <?php
                            } ?>
                        
                        </div>
                        
                    </div>
                    
                </div>
                <?php endif; ?>
                
                <div class="alba-blog-standard-block-content alba-blog-standard-<?php echo ( $images ) ? 'has-images' : 'no-images'; ?>">
                    
                    <header class="entry-header">
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                        <div class="entry-meta">
                            <?php if ( 'post' == get_post_type() ) : ?>
                                <i class="fa fa-calendar"></i> <?php kaira_posted_on(); ?>
                            <?php endif; ?>
                            <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                                <span class="comments-link"><i class="fa fa-comments"></i>  <?php comments_popup_link( __( '0 comments', 'albar' ), __( '1 Comment', 'albar' ), __( '% Comments', 'albar' ) ); ?></span>
                            <?php endif; ?>
                        </div>
                    </header>
                    
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>

                    <footer class="alba-blog-standard-post-footer">
                        <div class="alba-blog-standard-post-footer-left">
                            <?php
                            $categories_list = get_the_category_list( __( ', ', 'albar' ) );
                            if ( $categories_list && kaira_categorized_blog() ) : ?>
                            <span class="cat-links">
                                <i class="fa fa-list"></i> <?php printf( __( 'Posted in %1$s', 'albar' ), $categories_list ); ?>
                            </span>
                            <?php endif; ?>

                            <?php
                            $tags_list = get_the_tag_list( '', __( ', ', 'albar' ) );
                            if ( $tags_list ) : ?>
                            <span class="tags-links">
                                <i class="fa fa-tags"></i> <?php printf( __( 'Tags %1$s', 'albar' ), $tags_list ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="alba-blog-standard-post-footer-right">
                            <a href="<?php the_permalink(); ?>" class="alba-blog-permalink-btn"><?php _e( 'Read More', 'albar' ); ?></a>
                        </div>
                        <div class="clearboth"></div>
                    </footer>
                </div>
                <div class="clearboth"></div>
                
            </article>
            
        <?php
        endwhile; ?>
        
    </div>
    
    <?php kaira_content_nav( 'nav-below' ); ?>
    
<?php else: ?>
    
    <?php get_template_part( 'no-results', 'archive' ); ?>
    
<?php endif; wp_reset_query(); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                
                <section class="entry-content cf" itemprop="articleBody">
                  
                  <?php
                    // the content (pretty self explanatory huh)

                    the_content();


                    /*
                     * Link Pages is used in case you have posts that are set to break into
                     * multiple pages. You can remove this if you don't plan on doing that.
                     *
                     * Also, breaking content up into multiple pages is a horrible experience,
                     * so don't do it. While there are SOME edge cases where this is useful, it's
                     * mostly used for people to get more ad views. It's up to you but if you want
                     * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
                     *
                     * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
                     *
                    */
                    wp_link_pages( array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'BIGPIX' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                    ) );
                     echo get_the_tag_list('<div class="clear"></div><div class="tag-links">','','</div>');
                  ?>
                </section> <?php // end article section ?>

               <?php if ( get_theme_mod('BIGPIX_author_bio') ) {
                     $author_class = 'author-hide';
                    } else {
                    $author_class = '';
                    }
                ?>
                <?php if ( get_theme_mod('BIGPIX_related_posts') ) {
                     $related_class = 'related-hide';
                    } else {
                    $related_class = '';
                    }
                ?>
               <div class="next-prev-post">
                  <div class="prev">
                    <?php previous_post_link('<span>PREVIOUS POST</span> &larr; %link'); ?>
                  </div>
                  <div class="next">
                  <?php next_post_link('<span>NEXT POST</span> %link &rarr;'); ?>
                  </div>
                  <div class="clear"></div>
                </div> <!-- next-prev-post -->
                
                <footer class="article-footer <?php echo $author_class; ?>">
                  <div class="avatar">
                  <?php echo get_avatar( get_the_author_meta( 'ID' ) , 150 ); ?>
                  </div>
                  <div class="info">
                  <p class="author"><span>Written by</span> <?php the_author(); ?></p>
                  <p class="author-desc"> <?php if (function_exists('BIGPIX_author_excerpt')){echo BIGPIX_author_excerpt();} ?> </p>
                  </div>
                  <div class="clear"></div>
                </footer> <?php // end article footer ?>

                <?php
                    $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 4, 'post__not_in' => array($post->ID) ) ); ?>
                    <?php if (!empty($related)) { ?><div class="related posts <?php echo $related_class; ?>">
                    <h3>Related Posts</h3>
                    <ul> 
                    <?php if( $related ) foreach( $related as $post ) { ?>
                    <?php setup_postdata($post); ?>

                            <li>
                              <div class="related-image">
                              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php $image_thumb = BIGPIX_catch_that_image_thumb(); $gallery_thumb = BIGPIX_catch_gallery_image_thumb(); 
                                if ( has_post_thumbnail()){ the_post_thumbnail('BIGPIX-thumb-image-300by300');  ?>
                                <?php } elseif(has_post_format('gallery') && !empty($gallery_thumb)) { echo esc_url($gallery_thumb); ?>
                                <?php } elseif(has_post_format('image') && !empty($image_thumb)) { echo esc_url($image_thumb); ?>
                                <?php } else { ?>
                                <img src="<?php echo BIGPIX_IMAGES; ?>/blank.jpg">
                                <?php } ?>
                              </a>
                              </div>
                              <div class="related-info">
                                  <h3><?php the_title(); ?></h3>
                                  <?php the_excerpt(); ?>
                                  <p class="byline vcard">
                                      <?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> by ', 'BIGPIX' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?><?php the_author_posts_link(); ?>
                                    
                                  </p>
                              </div>
                               
                            </li>
                    
                    <?php }
                    wp_reset_postdata(); ?>
                     <div class="clear"></div>
                      </ul>

                     </div>
                     <?php } ?>
               

                <?php comments_template(); ?>

              </article> <?php // end article ?>
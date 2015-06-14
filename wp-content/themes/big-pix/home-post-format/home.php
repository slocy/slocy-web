<div class="the-post-title">
	<?php $category_list = get_the_category_list( __( ', ', 'BIGPIX' ) ); printf( __('%s', 'BIGPIX'), $category_list); ?>
	<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
	<div class="date">
		<?php printf( __( 'Posted on <time class="updated" datetime="%1$s" pubdate>%2$s</time> by ', 'BIGPIX' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format'))); ?>
		<?php the_author_posts_link(); ?>
	</div>
</div>
<div class="excerpt"><?php the_excerpt(); ?></div>
<div class="clear"></div>
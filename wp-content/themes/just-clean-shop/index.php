<?php get_header(); ?>   

		<div class="content">
			<?php if(have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?>>
			<div class="post-main">
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></span></h1>
				<div class="post">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php the_content( '' ); ?><div class="more-link"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php _e( 'Read more...', 'JustCleanShop' ); ?></a></div>
					<span class="entry-comments"><?php comments_popup_link( ) ?></span>
					<div class="categories"><div class="tagi"><?php the_tags(); ?></div>	<?php _e( 'Categories:', 'JustCleanShop' ); ?> <?php the_category(' '); ?></div>
				</div>
			</div> 
			</div> 
			<?php endwhile; ?>

		<?php if(function_exists('wp_pagenavi')) : ?>
		<div class="navigation"><?php wp_pagenavi(); ?></div>
		<?php else : ?>
						<div class="navigation">
							<div class="alignleft"><?php previous_posts_link(__('&laquo; Newer', 'JustCleanShop')) ?></div>
							<div class="alignright"><?php next_posts_link(__('Older &raquo;', 'JustCleanShop')) ?></div>
						</div>
						<?php endif; ?>
			<?php endif; ?>
		</div>
<div class="row">
	<div class="sidebar-right1 span2">
		<?php dynamic_sidebar( 'sidebar-left' ); ?>
	</div>
</div>





</div>
</div>
<?php get_footer(); ?>
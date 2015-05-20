<?php get_header(); ?>  
		<div class="content">
			<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
			<div class="post-main">
		
				<div class="post">
					<?php the_content(); ?><?php comments_template(); ?>
				</div>
			</div>
			<?php endwhile; ?>			
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
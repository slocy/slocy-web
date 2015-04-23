<?php global $product; ?>
<li class="block-3 <?php echo ( ! has_post_thumbnail() ) ? 'has-image-placeholder' : false; ?>">
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<section class="product">
			<figure class="product-thumb">
				<?php echo $product->get_image( 'simple-shop-425x280' ); ?>
			</figure>
			<section class="product-info cf">
				<h2><?php echo $product->get_title(); ?></h2>
				<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
				<p class="amount"><?php echo $product->get_price_html(); ?></p>
			</section>
		</section>
	</a>
</li>
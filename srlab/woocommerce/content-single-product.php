<?php

/**
 * The template for displaying product content in the single-product.php template
 * @package    srlab
 * @version    3.6.0
 */

defined('ABSPATH') || exit;

global $product;
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
} ?>
<section class="pd">
	<div class="compact">
		<div class="breadcrumbs"><?php woocommerce_breadcrumb(); ?></div>
		<section id="product-<?php the_ID(); ?>" <?php wc_product_class('content', $product); ?>>
		<div class="item-detail">
				<?php do_action('woocommerce_single_product_summary'); ?>
				<div class="description">
					<?php the_content(); ?>
				</div>

				<?php
				do_action('woocommerce_before_single_product_summary');
				do_action('woocommerce_after_single_product');
				do_action('woocommerce_single_product_pricing');
				// upsell_display/ output_related_products
				//do_action('woocommerce_after_single_product_summary');
				?>
			</div>

		</section>
	</div>
</section>
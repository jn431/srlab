<?php
/**
 * The template for displaying product category thumbnails within loops
 * @package 	srlab
 * @version 	4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div <?php wc_product_cat_class( 'product-card', $category ); ?>>
	<?php
	do_action( 'woocommerce_before_subcategory_title', $category );
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );
	do_action( 'woocommerce_after_subcategory_title', $category );
	?>
	<a href="<?= get_category_link($category); ?>" class="sec--btn b--more">View All</a>
</div>

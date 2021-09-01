<?php
/**
 * The template for displaying product category thumbnails within loops
 * @package 	srlab
 * @version 	4.7.0
 */
defined('ABSPATH') || exit;
$limit = 4;
?>
<div <?php wc_product_cat_class('product-card', $category); ?>>
	<?php
	do_action('woocommerce_before_subcategory_title', $category);
	do_action('woocommerce_shop_loop_subcategory_title', $category);
	$products = wc_get_products(
		[
			'limit' => $limit,
			'status' => 'publish',
			'category' => [$category->slug],
			'orderby' => 'name',
		]
	);
	echo "<ul class='list'>";
	foreach ($products as $product) :
		echo "<pre style='text-align: left'>";
		echo "</pre>";
		echo  "<li><a href='" . get_permalink($product->get_id()) . "'>{$product->get_title()}</a></li>";
	endforeach;
	echo "</ul>";
	do_action('woocommerce_after_subcategory_title', $category);
	?>
	<?php if ($category->count > $limit) : ?>
		<a href="<?= get_category_link($category); ?>" class="btn pri--btn b--more">View All</a>
	<?php endif; ?>
</div>
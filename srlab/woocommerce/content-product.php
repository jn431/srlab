<?php
/**
 * Page /shop PRODUCT LOOP
 * @package    srlab
 * @version    3.6.0
 */
defined('ABSPATH') || exit;
global $product;
if (empty($product) || !$product->is_visible())
   return;
?>
<div class="product-card">
   <div <?php wc_product_class('', $product); ?>>
      <div class="col">
         <?php do_action('woocommerce_after_shop_loop_item_title'); ?>
      </div>
      <div class="col">
         <div class="product-detail">
            <?php
            echo wc_get_product_category_list(get_the_ID());
            do_action('woocommerce_before_shop_loop_item');
            do_action('woocommerce_before_shop_loop_item_title'); // Image
            do_action('woocommerce_shop_loop_item_title');
            ?>
         </div>
         <?php
         the_excerpt();
         echo "<a href='" . get_the_permalink() . "' class='btn pri--btn b--hero'>Start Order</a>";
         ?>
      </div>
   </div>
</div>
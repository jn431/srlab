<?php
/**
 * Page /shop
 * @package    srlab
 * @version    3.4.0
 */
defined('ABSPATH') || exit;
get_header();
$page_id = get_option('woocommerce_shop_page_id');
do_action('woocommerce_before_main_content'); ?>
<section class="pd sf-wrap">
   <div class="compact">
      <?php
      if (is_shop()) {
         //echo "<h1 class='visually-hidden'>Products</h1>";
         echo "<h1 class='hd--1 title'>Available Services & Products</h1>";
      } else {
         echo (get_queried_object()) ? "<h1 class='hd--1 title'>" . get_queried_object()->name . "</h1>" : "";
      }
      if (woocommerce_product_loop()) :
         do_action('woocommerce_before_shop_loop');
         woocommerce_product_loop_start();
         if (wc_get_loop_prop('total')) : while (have_posts()) : the_post();
               do_action('woocommerce_shop_loop');
               wc_get_template_part('content', 'product');
            endwhile;
         endif;
         woocommerce_product_loop_end();
         do_action('woocommerce_after_shop_loop');
      else :
         do_action('woocommerce_no_products_found');
      endif;  ?>
   </div>
</section>
<?php
do_action('woocommerce_after_main_content');
get_footer();

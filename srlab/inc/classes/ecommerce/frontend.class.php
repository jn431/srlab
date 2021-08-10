<?php

namespace srlab\classes\Ecommerce;

defined('ABSPATH') || exit;

if (!class_exists('srlab\classes\Ecommerce\Frontend')) :
	class Frontend
	{
		public function __construct()
		{
			$this->sr_ecom_standalone();
			$this->sr_single_product_display();

			// * Product Card Image Wrap * //
			add_action('woocommerce_before_shop_loop_item_title', function () {
				echo '<div class="p-card_img">';
			}, 9);
			add_action('woocommerce_before_shop_loop_item_title', function () {
				echo '</div>';
			}, 11);
		}

		public function sr_ecom_standalone()
		{
			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);                       	// Hide default breadcrumbs
			remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');    	// Hide product wrapper link 1
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');    	// Hide product wrapper link 2
			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);                        	// Hide "Showing x results"
			remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);                       // Hide orderby
			add_filter('woocommerce_sale_flash', '__return_false');                                               	// Hide sale badge
			remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');									// Hide cross sell on cart page
			// Test
			remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
			add_action( 'before_page_content', 'woocommerce_output_all_notices', 10 );
		}

		public function sr_single_product_display()
		{
			//add_action('woocommerce_single_product_pricing', 'woocommerce_template_single_price', 10);					// [1.2] Move price to right
			//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);				// [1.1] Remove price from summary
			add_action('woocommerce_single_product_pricing', 'woocommerce_template_single_add_to_cart', 30);			// [2.2] Move add to cart input to right
			remove_action("woocommerce_before_single_product_summary", "woocommerce_show_product_images", 20);			// [1.0] Remove Product Image
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);	// Remove tabs
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);	    // [2.1] Remove add to cart input
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);					// Remove category
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);        	// Remove star reviews under title
		}
	} // End Class
endif;
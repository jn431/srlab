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
			$this->sr_checkout();
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
			remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
			add_action('before_page_content', 'woocommerce_output_all_notices', 10);
			add_filter('woocommerce_add_to_cart_fragments', [$this, 'sr_add_to_cart_fragment']);
			remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
			add_action('woocommerce_checkout_payment', 'woocommerce_checkout_payment', 20);
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
			add_filter('wc_add_to_cart_message_html', [$this, 'sr_added_cart_notice'], 10, 3);
		}
		public function sr_checkout()
		{
			add_filter('woocommerce_checkout_fields', [$this, 'sr_checkout_input']);
			add_action('woocommerce_before_checkout_form', [$this, 'sr_hide_checkout_coupon_form'], 5);
			add_filter('woocommerce_coupon_error', [$this, 'sr_promo_code_error_text'], 10, 3);
			//add_filter('woocommerce_shipping_fields', [$this, 'sr_checkout_input']);
		}

		/**
		 * Change promo code error message
		 * @see     woocommerce\includes\class-wc-discounts.php
		 * @param 	string  $err
		 * @param 	int 	  $err_code
		 * @param 	object  $parm
		 * @return 	string  $err
		 */
		public function sr_promo_code_error_text($err, $err_code, $parm)
		{
			switch ($err_code) {
				case 105:
					$err = sprintf(__('"%s" is in invalid code.', 'woocommerce'), $parm->get_code());
					break;
			}
			return $err;
		}


		/**
		 * Hide coupon field
		 */
		public function sr_hide_checkout_coupon_form()
		{
			echo '<style>.woocommerce-form-coupon-toggle {display:none;}</style>';
		}
		/**
		 * Show cart # count
		 * @param  array $fragments
		 * @var	  object $woocommerce
		 * @return array
		 */
		public function sr_add_to_cart_fragment($fragments)
		{
			global $woocommerce;
			$fragments['.cart-count'] = "<span class='cart-count'>" . $woocommerce->cart->cart_contents_count . "</span>";
			return $fragments;
		}
		public function sr_added_cart_notice($message, $products, $show_qty)
		{
			$url = esc_url(wc_get_cart_url());
			$message = sprintf('<span class="product-name"> %s </span> added to cart. <a href="%s" tabindex="1" class="view-cart">View Cart</a>', get_the_title(array_key_first($products)), $url);
			//$message = "Added to cart. <a href='$url'>View Cart</a>";
			return $message;
		}
		/**
		 * Checkout inputs and fields
		 * @param  array $fields
		 * @return array
		 */
		public function sr_checkout_input($fields)
		{
			foreach ($fields as &$fieldset) {
				foreach ($fieldset as &$field) {
					$field['class'][] = 'form-wrap';
					$field['input_class'][] = 'input';
				}
			}
			return $fields;
		}
	} // End Class
endif;

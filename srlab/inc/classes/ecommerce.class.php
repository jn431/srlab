<?php
namespace srlab\classes;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Ecommerce')) :
	class Ecommerce
	{
		public function __construct()
		{
			add_action('after_setup_theme', [$this, 'sr_woo_theme_support']);
			add_action('wp_enqueue_scripts', [$this, 'sr_woo_frontend_styles']);
			add_action('admin_enqueue_scripts', [$this, 'sr_woo_backend_styles'], 99);
			add_filter('woocommerce_enqueue_styles', '__return_false');
			add_filter('woocommerce_general_settings', [$this, 'add_phone_number_settings']);
			new Ecommerce\Frontend;
			new Ecommerce\UnitName;
			add_action('init', [$this, 'sr_set_woo_categories']);
		}
		/**
		 * Enqueue frontend store styles
		 */
		public function sr_woo_frontend_styles()
		{
			wp_deregister_style('wapf-frontend-css');
			wp_enqueue_style('theme-ecom', CSS_DIR . 'ecom.css', ['theme-style'], VERSION);
		}
		public function add_phone_number_settings($settings)
		{
			// Search array for the id you want
			$key              = array_search('woocommerce_store_postcode', array_column($settings, 'id')) + 1;
			$custom_setting[] = array(
				'title'    => __('Phone Number'),
				'desc'     => __("An additional, optional store phone number"),
				'id'       => 'woocommerce_store_phone_number',
				'default'  => '',
				'type'     => 'tel',
				'desc_tip' => true,
				'placeholder' => '(555)555-1234'
			);
			// Merge with existing settings at the specified index
			$new_settings = array_merge(array_slice($settings, 0, $key), $custom_setting, array_slice($settings, $key));
			return $new_settings;
		}
		/**
		 * Ecom Programmatically Add Categories
		 */
		public function sr_set_woo_categories()
		{
			$new_cats = [
				'Dentures' => 'dentures',
				'Orthodontics & Aligners' => 'orthodontics-and-aligners',
				'Printed Model'   => 'printed-model',
				'Prosthetic Restoration' => 'prosthetic-restoration',
				'Radiology Reports' => 'radiology-report',
				'Software Training & Planning Assistance' => 'software-training-and-planning',
				'Surgical Guides' => 'surgical-guides',
			];
			foreach ($new_cats as $cat => $slug) {
				wp_insert_term("$cat", 'product_cat', array(
					'description' => '', // optional
					'parent' => 0, // optional
					'slug' => "$slug" // optional
				));
			}
		}
		public function sr_woo_theme_support()
		{
			add_theme_support('woocommerce', array(
				'thumbnail_image_width' => 150,
				//'single_image_width'    => 300,
				'product_grid'          => array(
					'default_rows'    => 4,
					'min_rows'        => 2,
					'max_rows'        => 6,
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 5,
				),
			));
			add_theme_support('wc-product-gallery-lightbox');
		}
		public function sr_woo_backend_styles()
		{
			wp_deregister_style('wc-onboarding');
			wp_dequeue_style('woocommerce-activation');
			wp_deregister_style('woocommerce_admin_marketplace_styles');
		}
		public static function sr_woo_store_address()
		{
			$country    = get_option('woocommerce_default_country'); // CA:BC
			$split_country = ($country) ? explode(":", $country) : "";
			return $address = [
				"add_1"      		=> get_option('woocommerce_store_address') ?? "",
				"add_2"      		=> get_option('woocommerce_store_address_2') ?? "",
				"city"       		=> get_option('woocommerce_store_city') ?? "",
				"zip"        		=> get_option('woocommerce_store_postcode'),
				"country"    		=> $country,
				"split_country"   => $split_country,
				"store_country"   => ($split_country) ? $split_country[0] : "",
				"prov"				=> ($split_country) ? $split_country[1] : ""
			];
		}
	} // End Class
endif;

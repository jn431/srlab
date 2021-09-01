<?php
namespace srlab\classes\Ecommerce;
defined('ABSPATH') || exit;
if (!class_exists('srlab\classes\Ecommerce\UnitName')) :
	class UnitName
	{
		function __construct()
		{
			add_action('woocommerce_product_options_pricing', [$this, 'sr_unit_field']);
			add_action('woocommerce_admin_process_product_object', [$this, 'sr_save_unit_field']);
			add_action('woocommerce_after_quantity_input_field', [$this, 'sr_append_unitname_quantity']);
		}
		public function sr_unit_field()
		{
			global $product_object;
			$unit = $product_object->get_meta('_unit_name');
			echo "</div><div class='options_group'>";
			woocommerce_wp_text_input(array('id' => 'unit_name', 'type' => 'text', 'label' => __('Unit name', 'woocommerce-max-quantity'), 'placeholder' => 'e.g. "Jaw"', 'desc_tip' => 'true', 'description' => __('Set unit name (e.g. oz)', 'srlab'), 'custom_attributes' => [], 'value' => (isset($unit['unit_name']) && $unit['unit_name'] !== '') ? $unit['unit_name'] : '',));
		}
		public function sr_save_unit_field($product)
		{
			if (isset($_POST['unit_name'])) {
				$unit_name = $product->get_meta('_unit_name');
				$product->update_meta_data('_unit_name', ['unit_name' => isset($_POST['unit_name']) && $_POST['unit_name'] !== '' ? wc_clean(strtolower($_POST['unit_name'])) : '',]);
			} else $product->update_meta_data('_unit_name', []);
		}
		public function sr_append_unitname_quantity()
		{
			global $product;
			if (!$product && !is_object($product)) return;
			$unit = ($product->get_meta('_unit_name') && $product->get_meta('_unit_name')['unit_name'] !== '') ? $product->get_meta('_unit_name')['unit_name'] : '';
			echo "<span class='unit-name'>PER ".strtoupper($unit)."</span>";
		}
	} // End Class
endif;

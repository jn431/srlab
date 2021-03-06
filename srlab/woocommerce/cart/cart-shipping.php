<?php

/**
 * Shipping Methods Display
 * @package srlab
 * @version 3.6.0
 */
defined('ABSPATH') || exit;
$formatted_destination    = isset($formatted_destination) ? $formatted_destination : WC()->countries->get_formatted_address($package['destination'], ', ');
$has_calculated_shipping  = !empty($has_calculated_shipping);
$show_shipping_calculator = !empty($show_shipping_calculator);
$calculator_text          = '';
?>
<div class="shipping tr row--2">
	<div class="rs-label"><?php echo wp_kses_post($package_name); ?></div>
	<div class="rs-value" data-title="<?php echo esc_attr($package_name); ?>">
		<?php if ($available_methods) : ?>
			<ul id="shipping_method" class="">
				<?php foreach ($available_methods as $method) : ?>
					<li>
						<?php
						if (1 < count($available_methods)) {
							printf('<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id), checked($method->id, $chosen_method, false)); // WPCS: XSS ok.
						} else {
							printf('<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr(sanitize_title($method->id)), esc_attr($method->id)); // WPCS: XSS ok.
						}
						printf('<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr(sanitize_title($method->id)), wc_cart_totals_shipping_method_label($method)); // WPCS: XSS ok.
						do_action('woocommerce_after_shipping_rate', $method, $index);
						?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php if (is_cart()) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ($formatted_destination) {
						printf(esc_html__('Shipping to %s.', 'woocommerce') . ' ', '<strong>' . esc_html($formatted_destination) . '</strong>');
						$calculator_text = esc_html__('Change Address', 'woocommerce');
					} else {
						echo wp_kses_post(apply_filters('woocommerce_shipping_estimate_html', __('Shipping options will be updated during checkout.', 'woocommerce')));
					}
					?>
				</p>
			<?php endif; ?>
		<?php
		elseif (!is_cart()) :
			echo wp_kses_post(apply_filters('woocommerce_no_shipping_available_html', __('No shipping options available. Please ensure that your address has been entered correctly.', 'woocommerce')));
		else :
			echo wp_kses_post(apply_filters('woocommerce_cart_no_shipping_available_html', sprintf(esc_html__('No shipping options available.', 'woocommerce'))));
			$calculator_text = esc_html__('Calculate Shipping', 'woocommerce');
		endif;
		?>
		<?php
		if ($show_package_details) :
			echo '<p class="woocommerce-shipping-contents"><small>' . esc_html($package_details) . '</small></p>';
		endif;
		if ($show_shipping_calculator) :
			woocommerce_shipping_calculator($calculator_text);
		endif; ?>
	</div>
</div>
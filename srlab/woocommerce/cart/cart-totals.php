<?php

/**
 * Cart totals box
 * @package 	srlab
 * @version 	2.3.6
 */
defined('ABSPATH') || exit;
?>
<div class="tbl--2 cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">
	<h2 class="tr"><?php esc_html_e('Summary', 'woocommerce'); ?></h2>
	<?php do_action('woocommerce_before_cart_totals'); ?>
	<div class="tr row--2 cart-subtotal">
		<div class="rs-label"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
		<div class="rs-value" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
	</div>
	<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
		<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?> tr">
			<div class="rs-label"><?php wc_cart_totals_coupon_label($coupon); ?></div>
			<div class="rs-value" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></div>
		</div>
	<?php endforeach; ?>
	<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
		<?php do_action('woocommerce_cart_totals_before_shipping'); ?>
		<?php wc_cart_totals_shipping_html(); ?>
		<?php do_action('woocommerce_cart_totals_after_shipping'); ?>
	<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>
		<div class="tr row--2 shipping">
			<div class="rs-label"><?php esc_html_e('Shipping', 'woocommerce'); ?></div>
			<div class="rs-value" data-title="<?php esc_attr_e('Shipping', 'woocommerce'); ?>"><?php woocommerce_shipping_calculator(); ?></div>
		</div>
	<?php endif; ?>
	<?php foreach (WC()->cart->get_fees() as $fee) : ?>
		<div class="tr row--2 fee">
			<div class="rs-label"><?php echo esc_html($fee->name); ?></div>
			<div class="rs-value" data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></div>
		</div>
	<?php endforeach; ?>
	<?php
	if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) :
		$taxable_address = WC()->customer->get_taxable_address();
		$estimated_text  = '';
		if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) :
			$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
		endif;
		if ('itemized' === get_option('woocommerce_tax_total_display')) :
			foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
				<div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> tr">
					<div class="rs-label"><?php echo esc_html($tax->label) . $estimated_text; ?></div>
					<div class="rs-value" data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
				</div>
			<?php endforeach;
		else :
			?>
			<div class="tr row--2 tax-total">
				<div class="rs-label"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?></div>
				<div class="rs-value" data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php do_action('woocommerce_cart_totals_before_order_total'); ?>
	<div class="tr row--2 order-total">
		<div class="rs-label"><?php esc_html_e('Total', 'woocommerce'); ?></div>
		<div class="rs-value" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
	</div>
	<?php do_action('woocommerce_cart_totals_after_order_total'); ?>
	<div class="tr">
		<?php do_action('woocommerce_proceed_to_checkout'); ?>
	</div>
	<?php do_action('woocommerce_after_cart_totals'); ?>
</div>
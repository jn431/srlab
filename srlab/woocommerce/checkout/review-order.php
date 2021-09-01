<?php

/**
 * Review order table
 * @package 	srlab
 * @version 	5.2.0
 */
defined('ABSPATH') || exit;
?>
<div class="tile woocommerce-checkout-review-order-table">
	<?php
	do_action('woocommerce_review_order_before_cart_contents');
	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
		$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
		if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) :
	?>
			<div class="<?= esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> fl-wrap">
				<div class="col product-detail">
					<h4 class="product-name"><?= wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?></h4>
					<?= wc_get_formatted_cart_item_data($cart_item); ?>
				</div>
				<div class="col product-subtotal">
					<?php
					echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
					echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <span class="qty">' . sprintf('Qty: %s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key);
					?>
				</div>
			</div>
	<?php
		endif;
	endforeach;
	do_action('woocommerce_review_order_after_cart_contents');
	?>
	<div id="cart-subtotal" class="tbl--2">
		<div class="tr row--2 totals">
			<div class="rs-label"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
			<div class="rs-value"><?php wc_cart_totals_subtotal_html(); ?></div>
		</div>
		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<div class="tr row--2 cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<div class="rs-label"><?php wc_cart_totals_coupon_label($coupon); ?></div>
				<div class="rs-value"><?php wc_cart_totals_coupon_html($coupon); ?></div>
			</div>
		<?php endforeach; ?>
		<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
			<?php do_action('woocommerce_review_order_before_shipping'); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action('woocommerce_review_order_after_shipping'); ?>
		<?php endif; ?>
		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<div class="tr row--2 fee">
				<div class="rs-label"><?php echo esc_html($fee->name); ?></div>
				<div class="rs-value"><?php wc_cart_totals_fee_html($fee); ?></div>
			</div>
		<?php endforeach; ?>
		<?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
			<?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
				<?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
					<div class="tr row--2 tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
						<div class="rs-label"><?php echo esc_html($tax->label); ?></div>
						<div class="rs-value"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="tr row--2 tax-total">
					<div class="rs-label"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></div>
					<div class="rs-value"><?php wc_cart_totals_taxes_total_html(); ?></div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php do_action('woocommerce_review_order_before_order_total'); ?>
		<div class="tr row--2 order-total">
			<div class="rs-label"><?php esc_html_e('Total', 'woocommerce'); ?></div>
			<div class="rs-value"><?php wc_cart_totals_order_total_html(); ?></div>
		</div>
		<?php do_action('woocommerce_review_order_after_order_total'); ?>
	</div>
</div>